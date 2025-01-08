<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Bet, BetOutcome, BetSlip, ErrorLog, Grouping, MpesaRequest, MpesaTransaction, Subscription, SubscriptionType, User};

use \Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->_date = Carbon::now();
    }

    public function dashboard(){
        return view('pages.admin.index',[
            'title' => 'Dashboard',
            'nav'   => 'admin.dashboard',
        ]);
    }

    public function getPredictions($category){
        if($category == 'all'){
            $bets = Bet::orderBy('starts_at', 'DESC')->paginate(50);
            $title = "All Bets (" . number_format($bets->total()) . ")";
        } 

        else if($category == 'active'){
            $bets = Bet::where('starts_at' ,'>=', $this->_date->subHours(2))->orderBy('starts_at', 'DESC')->paginate(50);
            $title = "Active Bets (" . number_format($bets->total()) . ")";
        }

        else if($category == 'premium'){
            $bets = Bet::where('free' ,'0')->orderBy('starts_at', 'DESC')->paginate(50);
            $title = "Premium Bets (" . number_format($bets->total()) . ")";
        }

        else if($category == 'free'){
            $bets = Bet::where('free' ,'1')->orderBy('starts_at', 'DESC')->paginate(50);
            $title = "Free Bets (" . number_format($bets->total()) . ")";
        }

        else if($category == 'won'){
            $bets = Bet::where('status' , '1')->orderBy('starts_at', 'DESC')->paginate(50);
            $title = "Lost Bets (" . number_format($bets->total()) . ")";
        }

        else if($category == 'lost'){
            $bets = Bet::where('status' , '-1')->orderBy('starts_at', 'DESC')->paginate(50);
            $title = "Lost Bets (" . number_format($bets->total()) . ")";
        }

        else{
            session()->flash('error', 'Page Not Found');
            return redirect()->back();
        }
        
        
        return view('pages.admin.predictions',[
            'title'     => $title,
            'nav'       => 'admin.predictions',
            'bets'      => $bets,
            'category'  => $category,
        ]);
    }

    public function getBetGroups($category){
        if($category == 'active'){
            $bet_slips = BetSlip::where('starts_at', '>=', $this->_date->subHours(2))->orderBy('starts_at', 'DESC')->paginate(50);
            $title = "Active Bet Groups (" . number_format($bet_slips->total()) . ")";
        }

        else if($category == 'all'){
            $bet_slips = BetSlip::orderBy('starts_at', 'DESC')->paginate(50);
            $title = "All Bet Groups (" . number_format($bet_slips->total()) . ")";
        }

        else if($category == 'finished'){
            $bet_slips = BetSlip::where('starts_at', '<', $this->_date->subHours(2))->orderBy('starts_at', 'DESC')->paginate(50);
            $title = "Finished Bet Groups (" . number_format($bet_slips->total()) . ")";
        }

        else{
            session()->flash('error', "Page not found");
            return redirect()->back();
        }
        
        
        return view('pages.admin.bet-groups',[
            'title'     => $title,
            'nav'       => 'admin.bet-groups',
            'category'  => $category,
            'bet_slips' => $bet_slips,
        ]);
    }

    public function getSubscriptions($category){
        if($category == 'all'){
            $subscriptions = Subscription::where('subscription_type', 'predictions')->orderBy('ends_at', 'DESC')->paginate(50);
            $title = "All Subscriptions (" . number_format($subscriptions->total()) . ")";
        }

        else if($category == 'active'){
            $subscriptions = Subscription::where('subscription_type', 'predictions')->where('ends_at', '>=', $this->_date)->orderBy('ends_at', 'DESC')->paginate(50);
            $title = "Active Subscriptions (" . number_format($subscriptions->total()) . ")";
        }

        else if($category == 'expired'){
            $subscriptions = Subscription::where('subscription_type', 'predictions')->where('ends_at', '<', $this->_date)->orderBy('ends_at', 'DESC')->paginate(50);
            $title = "Expired Subscriptions (" . number_format($subscriptions->total()) . ")";
        }

        else{
            session()->flash('error', "Page not found");
            return redirect()->back();
        }
        
        return view('pages.admin.subscriptions',[
            'title'         => $title,
            'nav'           => 'admin.subscriptions',
            'subscriptions' => $subscriptions,
            'category'      => $category,
        ]);
    }

    public function getSmsSubscriptions($category){
        if($category == 'all'){
            $subscriptions = Subscription::where('subscription_type', 'sms')->orderBy('ends_at', 'DESC')->paginate(50);
            $title = "All SMS Subscriptions (" . number_format($subscriptions->total()) . ")";
        }

        else if($category == 'active'){
            $subscriptions = Subscription::where('subscription_type', 'sms')->where('ends_at', '>=', $this->_date)->orderBy('ends_at', 'DESC')->paginate(50);
            $title = "Active SMS Subscriptions (" . number_format($subscriptions->total()) . ")";
        }

        else if($category == 'expired'){
            $subscriptions = Subscription::where('subscription_type', 'sms')->where('ends_at', '<', $this->_date)->orderBy('ends_at', 'DESC')->paginate(50);
            $title = "Expired SMS Subscriptions (" . number_format($subscriptions->total()) . ")";
        }

        else{
            session()->flash('error', "Page not found");
            return redirect()->back();
        }
        
        return view('pages.admin.subscriptions',[
            'title'         => $title,
            'nav'           => 'admin.sms-subscriptions',
            'subscriptions' => $subscriptions,
            'category'      => $category,
        ]);
    }

    public function getTransactions($category){
        if($category == 'all'){
            $transactions = MpesaTransaction::orderBy('TransactionDate', 'DESC')->paginate(50);
            $title = "All Transactions (" . number_format($transactions->total()) .")";
        }  
        
        else{
            session()->flash('error', "Page not found");
            return redirect()->back();
        }
        
        return view('pages.admin.transactions',[
            'title'         => $title,
            'nav'           => 'admin.transactions',
            'category'      => $category,
            'transactions'  => $transactions,
        ]);
    }

    public function getUsers($category){
        if($category == 'all'){
            $users = User::where('user_type', 'STANDARD')->paginate(50);
            $title = "All Users (" . number_format($users->total()) . ")";
        }

        if($category == 'active'){
            $users = User::whereNotNull('subscription_expires_at')->where('subscription_expires_at','>=', $this->_date)->where('user_type', 'STANDARD')->paginate(50);
            $title = "Users Subscribed to Premium (" . number_format($users->total()) . ")";
        }

        if($category == 'inactive'){
            $users = User::whereNull('subscription_expires_at')->orWhere('subscription_expires_at','<', $this->_date)->where('user_type', 'STANDARD')->paginate(50);
            $title = "Users Not Subscribed to Premium (" . number_format($users->total()) . ")";
        }

        if($category == 'active-sms'){
            $users = User::whereNotNull('subscription_expires_at')->where('sms_subscription_expires_at','>=', $this->_date)->where('user_type', 'STANDARD')->paginate(50);
            $title = "Users Subscribed to SMS (" . number_format($users->total()) . ")";
        }

        if($category == 'inactive-sms'){
            $users = User::whereNull('subscription_expires_at')->orWhere('sms_subscription_expires_at','<', $this->_date)->where('user_type', 'STANDARD')->paginate(50);
            $title = "Users Not Subscribed to SMS (" . number_format($users->total()) . ")";
        }

        if($category == 'analyst'){
            $users = User::where('user_type', 'ANALYST')->paginate(50);
            $title = "Analysts (" . number_format($users->total()) . ")";
        }

        if($category == 'admin'){
            $users = User::where('user_type', 'ADMIN')->paginate(50);
            $title = "Admins (" . number_format($users->total()) . ")";
        }
        
        return view('pages.admin.users',[
            'title'     => $title,
            'nav'       => 'admin.users',
            'users'     => $users,
            'category'  => $category,
            'now'       => $this->_date,
        ]);
    }

    public function postAddUser(){
        $request = request();

        if(!preg_match("/^(254)([0-9]+)$/i", $request->phone) || strlen($request->phone) != 12){
            session()->flash('error', "Invalid phone. Please use the format 254XXXXXXXXX");
            return redirect()->back()->withData();
        }
        
        $this->validate($request, [
            'name'      => 'required|max:191',
            'email'     => 'email|required|max:191|unique:users,email',
            'phone'     => 'numeric|required|unique:users,phone',
            'user_type' => 'required|max:191',
            'password'  => 'required|max:191|min:8',
        ]);

        

        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->user_type    = $request->user_type;
        $user->password     = bcrypt($request->password);
        $user->save();

        session()->flash('success', 'User Created');
        return redirect()->back();
    }

    public function getSiteSettings(){
        return view('pages.admin.site-settings',[
            'title' => 'Site Settings',
            'nav'   => 'admin.site-settings',
        ]);
    }

    public function getSettings(){
        return view('pages.admin.settings',[
            'title' => 'Settings',
            'nav'   => 'admin.settings',
        ]);
    }

    public function postSettings(){
        $request = request();
        $user = auth()->user();

        $this->validate($request,[
            'name'      => 'required|max:191',
            'email'     => 'required|email|max:191',
            'phone'     => 'numeric|required|min:0',
        ]);

        if($request->email != $user->email){
            $this->validate($request, [
                'email' => 'unique:users',
            ]);
        }

        if($request->phone != $user->phone){
            $this->validate($request, [
                'phone' => 'unique:users',
            ]);
        }

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->update();

        session()->flash('success', 'Profile updated');
        return redirect()->back();
    }
}
