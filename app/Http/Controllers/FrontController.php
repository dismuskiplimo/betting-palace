<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{User, ErrorLog, Bet, SubscriptionType};

use Image;

use \Carbon\Carbon;

class FrontController extends Controller
{
    public function __construct(){
        $this->_date = Carbon::now();
    }

    function getIndexPage(){       
        $bets = Bet::where('free', '1')->where('starts_at', '>', $this->_date->subHours(2))->limit(10)->get();
        $subscription_types = SubscriptionType::orderBy('price', 'ASC')->get();
        return view('pages.index', [
            'title'                 => 'Home Page',
            'nave'                  => 'homepage',
            'bets'                  => $bets,
            'subscription_types'    => $subscription_types,
        ]);
    }
    
    // send email
    function sendRoomBookingReceivedEmail(RoomBooking $booking){
        if(config('mail.enabled')){
            // send email to NCIA

            $message = "Booking request for " . $booking->room->room_name . " received." ;

            $title = config('app.name') . " | " . $message;

            $salutation = "Admin";

            try{
                \Mail::send('emails.booking-received', ['title' => $title, 'booking'=>$booking, 'salutation' => $salutation], function ($message) use($title){
                    $message->subject($title);
                    $message->to(env('ROOM_BOOKING_APPLICATION_EMAIL'));
                });

            }catch(\Exception $e){
                session()->flash('error', $e->getMessage());
                $this->log_error($e);
                //dd($e);
            }

            // send email to Applicant

            $message = "Booking request for " . $booking->room->room_name . " received.";

            $title = config('app.name') . " | " . $message;

            $salutation = $booking->contact_name;

            try{
                \Mail::send('emails.booking-received', ['title' => $title, 'booking'=>$booking, 'salutation' => $salutation], function ($message) use($title, $booking){
                    $message->subject($title);
                    $message->to($booking->email);
                });

            }catch(\Exception $e){
                session()->flash('error', $e->getMessage());
                $this->log_error($e);
                //dd($e);
            }
        
        }
    }
}

