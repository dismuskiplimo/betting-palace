<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Carbon\Carbon;

use App\{Bet, BetSlip};

class StandardUserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_standard_user');
        $this->middleware('verify_subscription');
        
        $this->_date = Carbon::now();
    }

    public function dashboard(){
        $user = auth()->user();
        $now = $this->_date->subHours(2);
        
        return view('pages.standard-user.index',[
            'title' => 'Dashboard',
            'nav'   => 'standard-user.dashboard',
            'user'  => $user,
            'free_bets' => Bet::where('free', '1')->where('starts_at', '>=', $now)->get(),
            'paid_bets' => Bet::where('free', '0')->where('starts_at', '>=', $now)->get(),
            'bet_slips' => BetSlip::where('starts_at', '>=', $now)->orderBy('starts_at', 'DESC')->get(),
        ]);
    }

    public function getHistory(){
        $user = auth()->user();

        if($user->subscription_active()){
            $bets = Bet::where('status', '-1')->orWhere('status', '1')->orderBy('starts_at', 'DESC')->paginate(50);
        }else{
            $bets = Bet::where('free', '1')->where('status', '-1')->orWhere('status', '1')->orderBy('starts_at', 'DESC')->paginate(50);
        }
        
        return view('pages.standard-user.history',[
            'title' => 'Past Games',
            'nav'   => 'standard-user.history',
            'user'  => $user,
            'bets'  => $bets,
        ]);
    }

    public function getSubscriptions(){
        return view('pages.standard-user.subscriptions',[
            'title' => 'Subscriptions',
            'nav'   => 'standard-user.subscriptions',
            'user'  => auth()->user(),
        ]);
    }

    public function getSettings(){
        return view('pages.standard-user.settings',[
            'title' => 'Settings',
            'nav'   => 'standard-user.settings',
        ]);
    }

    public function postSettings(){
        $request = request();
        $user = auth()->user();

        if(!preg_match("/^(254)([0-9]+)$/i", $request->phone) || strlen($request->phone) != 12){
            session()->flash('error', "Invalid phone. Please use the format 254XXXXXXXXX");
            return redirect()->back()->withData();
        }

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
