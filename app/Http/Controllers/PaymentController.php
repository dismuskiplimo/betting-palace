<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{ErrorLog, MpesaRequest, SubscriptionType, MpesaTransaction, User, Subscription};

use \Carbon\Carbon;

class PaymentController extends Controller
{
    protected 
              $_mpesa_consumer_key,
              $_mpesa_consumer_secret,
              $_mpesa_shortcode,
              $_mpesa_auth_url,
              $_mpesa_request_url,
              $_mpesa_query_url,
              $_mpesa_access_token,
              $_mpesa_mode,
              $_mpesa_passkey;

    protected $_mpesa_errors = [
    	'0' => 'Success',
    	'1' => 'Insufficient Funds',
    	'2' => 'Less Than Minimum Transaction Value',
    	'3' => 'More Than Maximum Transaction Value',
    	'4' => 'Would Exceed Daily Transfer Limit',
    	'5' => 'Would Exceed Minimum Balance',
    	'6' => 'Unresolved Primary Party',
    	'7' => 'Unresolved Receiver Party',
    	'8' => 'Would Exceed Maxiumum Balance',
    	'11' => 'Debit Account Invalid',
    	'12' => 'Credit Account Invalid',
    	'13' => 'Unresolved Debit Account',
    	'14' => 'Unresolved Credit Account',
    	'15' => 'Duplicate Detected',
    	'17' => 'Internal Failure',
    	'20' => 'Unresolved Initiator',
    	'26' => 'Traffic blocking condition in place',
    ];

    public function __construct(){
        $this->_date = new \Carbon\Carbon(config('app.tz'));

        $this->_mpesa_mode = env('MPESA_MODE');
               
        if($this->_mpesa_mode == 'live'){
        	$this->_mpesa_consumer_key = env('MPESA_CONSUMER_KEY_LIVE');
        	$this->_mpesa_consumer_secret = env('MPESA_CONSUMER_SECRET_LIVE');
            $this->_mpesa_shortcode = env('MPESA_SHORTCODE_LIVE');
            $this->_mpesa_passkey = env('MPESA_PASSKEY_LIVE');
        	$this->_mpesa_auth_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        	$this->_mpesa_request_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        	$this->_mpesa_query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
        }elseif($this->_mpesa_mode == 'sandbox'){
        	$this->_mpesa_consumer_key = env('MPESA_CONSUMER_KEY_SANDBOX');
        	$this->_mpesa_consumer_secret = env('MPESA_CONSUMER_SECRET_SANDBOX');
            $this->_mpesa_shortcode = env('MPESA_SHORTCODE_SANDBOX');
            $this->_mpesa_passkey = env('MPESA_PASSKEY_SANDBOX');
        	$this->_mpesa_auth_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        	$this->_mpesa_request_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        	$this->_mpesa_query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
        }
    }

    public function requestMpesaAccessToken(){
    	$url = $this->_mpesa_auth_url;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode( $this->_mpesa_consumer_key . ':' . $this->_mpesa_consumer_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        try {
        	list($header, $body) = explode("\r\n\r\n", $response, 2);

	        $fields = json_decode($body);
	        
	        $this->_mpesa_access_token = $fields->access_token;
        } catch (\Exception $e) {
        	$log = new ErrorLog;
        	$log->title     = $e->getMessage();
            $log->content   = $e;
        	$log->save();
        }
    }

    public function requestMpesaPayment($type){
        $request = request();
        $user = auth()->user();

        if(!preg_match("/^(254)([0-9]+)$/i", $request->phone) || strlen($request->phone) != 12){
            session()->flash('error', "Invalid phone. Please use the format 254XXXXXXXXX");
            return redirect()->back()->withData();
        }

        $amount = 1;
        $description = "";
        $value = "";

        if($type == 'predictions'){
            $this->validate($request,[
                'subscription_type_id'  => 'required|numeric|min:1',
                'phone'                 => 'required|numeric|min:0',
            ]);
    
            $subscriptionType = SubscriptionType::find($request->subscription_type_id);
    
            if(!$subscriptionType){
                session()->flash('error', 'Invalid subscription type');
                return redirect()->back();
            }

            $amount = $subscriptionType->price;
            $description = "Payment for " . $subscriptionType->subscription_type;
            $value = $subscriptionType->id;


        }elseif($type == 'sms'){
            $this->validate($request,[
                'no_of_days'            => 'required|numeric|min:1',
                'phone'                 => 'required|numeric|min:0',
            ]);

            if($user->subscription_active()){
                if($request->no_of_days > $user->subscription_expires_at->diffInDays(Carbon::now(config('app.tz')))){
                    session()->flash('error', 'SMS subscription cannot exceed your prediction subscription. Please try again');
                    return redirect()->back();
                }
            }else{
                session()->flash('error', 'You must have an active subscription before enabling SMS updates');
                return redirect()->back();
            }

            $amount = $request->no_of_days * env('SMS_PRICE');
            $description = 'Payment for SMS notifications for ' . $request->no_of_days . 'days';
            $value = $request->no_of_days;

        }else{
            session()->flash('error', 'Invalid request');
            return redirect()->back();
        }
    	
    	if($this->_mpesa_mode == 'sandbox'){
    		$amount = 1;
    	}else{
    		$amount = (int)ceil($amount);
    	}
    	
        $phone = $request->phone;

        $this->requestMpesaAccessToken();
        
        if($this->_mpesa_access_token){
            $url = $this->_mpesa_request_url;

            $shortcode = $this->_mpesa_shortcode;
            $passkey = $this->_mpesa_passkey;
            $timestamp = $this->_date->format('YmdHis');

            $callback = route('payment.process.mpesa', ['type' => $type, 'value' => $value, 'user_id' => $user->id]);

            $password = base64_encode($shortcode.$passkey.$timestamp);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ' . $this->_mpesa_access_token ));

            $curl_post_data = [
              'BusinessShortCode' => $shortcode,
              'Password' => $password,
              'Timestamp' => $timestamp,
              'TransactionType' => 'CustomerPayBillOnline',
              'Amount' => $amount,
              'PartyA' => $phone,
              'PartyB' => $shortcode,
              'PhoneNumber' => $phone,
              'CallBackURL' => $callback,
              'AccountReference' => config('app.name'),
              'TransactionDesc' => $description, 
            ];

            $data_string = json_encode($curl_post_data);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

            $curl_response = curl_exec($curl);

            $response = json_decode($curl_response);

            if(isset($response->errorCode) && !empty($response->errorCode)){
                session()->flash('error', $response->errorMessage);
                return redirect()->back();

                
            }else{
                if(isset($response->ResponseCode) && $response->ResponseCode == 0){
                    session()->flash('success', 'MPESA request received, please input your PIN and press Ok');
                
                    return redirect()->back();
                    
                }elseif(isset($response->ResponseCode) && $response->ResponseCode != 0){
                    session()->flash('error', $response->ResponseDescription);
                    return redirect()->back();
                }else{
                    return redirect()->back();
                }
                

            }
                
        }else{
            session()->flash('error', 'Please ensure that you are online');
            return redirect()->back();
        }
    }

    public function processMpesaRequest($type, $value, $user_id){
    	        
        $request = request();
        $description = "";
        $user = User::find($user_id);

        $error_log = new ErrorLog();
        $error_log->title = "MPESA Response";
        $error_log->content = $request;
        $error_log->save();

        if($type == 'sms'){
            $description = 'Payment for SMS subscription for ' . $value . ' day(s)';
        }else if ($type == 'predictions'){
            
            $subscriptionType = SubscriptionType::find($value);
            if($subscriptionType){
                $description = "Payment for " . $subscriptionType->subscription_type . ' subscription';
            }else{
                
                // subscription not found
                $error_log = new ErrorLog();
                $error_log->title = "Subscription " . $request->subscription_type_id . "not Found";
                $error_log->content = $error_log->title;
                $error_log->save();
                
                
            }
            
        }else{
            // invalid request
            $error_log = new ErrorLog();
            $error_log->title = "Invalid request {" . $type . "} by user" . $user_id;
            $error_log->content = $error_log->title;
            $error_log->save();
            
            
        }

        // store
        try {
            list($header, $body) = explode("\r\n\r\n", $request, 2);

            $fields = json_decode($body);

            $response = $fields->Body->stkCallback;  

            $mpesa_request                      = new MpesaRequest;
            $mpesa_request->user_id             = $user_id;  
            $mpesa_request->description         = $description; 
            
            $mpesa_request->MerchantRequestID   = $response->MerchantRequestID; 
            $mpesa_request->CheckoutRequestID   = $response->CheckoutRequestID; 
            $mpesa_request->ResultDesc          = $response->ResultDesc;    
            $mpesa_request->ResultCode          = $response->ResultCode;    
            $mpesa_request->save();     
            

            if($response->ResultCode == 0){

                $items = $response->CallbackMetadata->Item;

                $details = [];

                foreach ($items as $item) {
                    $details[$item->Name] = isset($item->Value) ? $item->Value : null;
                }

                if($mpesa_request->ResultCode == 0){
                    $mpesa_transaction                      = new MpesaTransaction;
                    $mpesa_transaction->Amount              = $details['Amount'];
                    $mpesa_transaction->MpesaReceiptNumber  = $details['MpesaReceiptNumber'];
                    $mpesa_transaction->Balance             = $details['Balance'];
                    $mpesa_transaction->TransactionDate     = Carbon::createFromFormat('YmdHis', $details['TransactionDate'], config('app.tz'))->toDateTimeString();
                    $mpesa_transaction->PhoneNumber         = $details['PhoneNumber'];
                    $mpesa_transaction->user_id             = $user->id;
                    $mpesa_transaction->description         = $description;
                    $mpesa_transaction->mpesa_request_id    = $mpesa_request->id;
                    $mpesa_transaction->save();

                    // update
                    
                    if($type == 'sms'){
                        $starts_at  = Carbon::now(config('app.tz'));
                        $ends_at    = Carbon::now(config('app.tz'))->addDays($value);

                        $user->sms_subscription_expires_at = $ends_at;
                        $user->update();
                    }else if($type == 'predictions'){
                        $starts_at  = Carbon::now(config('app.tz'));
                        $ends_at    = Carbon::now(config('app.tz'))->addDays($subscriptionType->no_of_days);
                                                
                        if($user->subscription_active() && $user->subscription_expires_at->gt($starts_at)){
                            $days = 10;
                            $starts_at = $user->subscription_expires_at->addDays($days);
                            $ends_at = $starts_at->addDays($days);
                        }                        

                        $user->subscription_expires_at = $ends_at;
                        $user->update();
                    }

                    $subscription                       = new Subscription;
                    $subscription->user_id              = $user->id;
                    $subscription->starts_at            = $starts_at;
                    $subscription->ends_at              = $ends_at;
                    $subscription->subscription_type    = $type;
                    $subscription->subscription_details = $description;
                    $subscription->mpesa_number         = $mpesa_transaction->PhoneNumber;
                    $subscription->mpesa_amount         = $mpesa_transaction->Amount;
                    $subscription->mpesa_trx_code       = $mpesa_transaction->MpesaReceiptNumber;
                    $subscription->completed_at         = $mpesa_transaction->TransactionDate;
                    $subscription->save();
                }   

                
            }else{
                $message = $description . ' Failed. Reason : ' . $response['ResultDesc'];

                $log = new ErrorLog;
                $log->title = $message;
                $log->content = $message;
                $log->save();
            }           
        } catch (\Exception $e) {
            $log = new ErrorLog;
            $log->title = $e->getMessage();
            $log->content = $e;
            $log->save();
        }
    }
}
