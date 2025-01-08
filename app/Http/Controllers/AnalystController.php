<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Bet,BetSlip,Grouping};

use \Carbon\Carbon;

class AnalystController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_analyst');
        $this->_date = Carbon::now();
    }

    public function dashboard(){
        $now = $this->_date->subHours(2);

        $betslips = BetSlip::where('starts_at', '>=', $now)->orderBy('starts_at', 'DESC')->get();

        foreach($betslips as $betslip){
            if(!$betslip->bets()->count()){
                $betslip->delete();
            }
        }

        $betslips = BetSlip::where('starts_at', '>=', $now)->orderBy('starts_at', 'DESC')->get();
        
        return view('pages.analyst.index',[
            'title' => 'Dashboard',
            'nav'   => 'analyst.dashboard',
            'free_bets' => Bet::where('free', '1')->where('starts_at', '>=', $now)->get(),
            'paid_bets' => Bet::where('free', '0')->where('starts_at', '>=', $now)->get(),
            'active_bets' => Bet::where('starts_at', '>=', $now)->get(),
            'bet_slips' => $betslips,
        ]);
    }

    public function postAddBet(){
        $request = request();

        $this->validate($request, [
            'league'                => 'required|max:191',
            'gameId'                => 'numeric:min:0',
            'homeName'              => 'required|max:191',
            'awayName'              => 'required|max:191',
            'starts_at'             => 'date|max:191|required',
            'minute'                => 'min:0|max:60|required',
            'hour'                  => 'min:0|max:23|required',
            'prediction'            => 'required|max:191',
            'free'                  => 'numeric|min:0|max:1',
            'predictedHomeScore'    => 'max:191',
            'predictedAwayScore'    => 'max:191',
        ]);

        $starts_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at . ' ' . $request->hour . ':' . $request->minute . ':00', config('app.tz'));

        $bet                        = new Bet();
        $bet->league                = $request->league;
        $bet->gameId                = $request->gameId;
        $bet->homeName              = $request->homeName;
        $bet->awayName              = $request->awayName;
        $bet->starts_at             = $starts_at;
        $bet->prediction            = $request->prediction;
        $bet->free                  = $request->free;
        $bet->predictedHomeScore    = $request->predictedHomeScore;
        $bet->predictedAwayScore    = $request->predictedAwayScore;
        $bet->user_id               = auth()->user()->id;

        $bet->save();

        session()->flash('success', 'Prediction Added');

        return redirect()->back();
    }

    public function postAddBetToBetslip(){
        $request = request();

        $this->validate($request, [
            'bets'      => 'required|array|min:2',
            'bets.*'    => 'numeric|min:0|distinct',
        ]);

        $now = new \Carbon\Carbon(); 

        $betslip = new BetSlip();
        $betslip->starts_at = $now;
        $betslip->save();

        foreach($request->bets as $bet){
            $grouping = new Grouping();
            $grouping->bet_id = $bet;
            $grouping->bet_slip_id = $betslip->id;
            $grouping->save();

            if($grouping->bet->starts_at && $grouping->bet->starts_at->gt($betslip->starts_at)){
                $betslip->starts_at = $grouping->bet->starts_at;
                $betslip->update();
            }
        }

        session()->flash('success', 'Bet Group Created');
        return redirect()->back();
    } 

    public function updateBet($id){
        $request = request();

        $bet = Bet::find($id);

        if(!$bet){
            session()->flash('error', 'Bet not found');
            return redirect()->back();
        }

        $this->validate($request, [
            'league'                => 'required|max:191',
            'gameId'                => 'numeric:min:0',
            'homeName'              => 'required|max:191',
            'awayName'              => 'required|max:191',
            'starts_at'             => 'date|max:191|required',
            'minute'                => 'min:0|max:60|required',
            'hour'                  => 'min:0|max:23|required',
            'prediction'            => 'required|max:191',
            'free'                  => 'numeric|min:0|max:1',
            'predictedHomeScore'    => 'max:191',
            'predictedAwayScore'    => 'max:191',
            'homeScore'             => 'max:191',
            'awayScore'             => 'max:191',
            'status'                => 'numeric|min:-1|max:1',
        ]);

        $starts_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at . ' ' . $request->hour . ':' . $request->minute . ':00', config('app.tz'));

        $bet->league                = $request->league;
        $bet->gameId                = $request->gameId;
        $bet->homeName              = $request->homeName;
        $bet->awayName              = $request->awayName;
        $bet->starts_at             = $starts_at;
        $bet->prediction            = $request->prediction;
        $bet->free                  = $request->free;
        $bet->predictedHomeScore    = $request->predictedHomeScore;
        $bet->predictedAwayScore    = $request->predictedAwayScore;
        $bet->homeScore             = $request->homeScore;
        $bet->awayScore             = $request->awayScore;
        $bet->status                = $request->status;

        $bet->update();

        session()->flash('success', 'Bet Updated');
        return redirect()->back();
    }

    public function deleteBet($id){
        $bet = Bet::find($id);

        if(!$bet){
            session()->flash('error', 'Bet not found');
            return redirect()->back();
        }

        foreach($bet->groups()->get() as $betgroup){
            $betgroup->delete();
        }

        $bet->delete();
        
        session()->flash('success', 'Bet Deleted');

        return redirect()->back();
    }

    public function deleteBetGroup($id){
        $betslip = Betslip::find($id);

        if(!$betslip){
            session()->flash('error', 'Bet Group not found');
            return redirect()->back();
        }

        foreach($betslip->bets()->get() as $bet){
            $bet->delete();
        }

        $betslip->delete();
        
        session()->flash('success', 'Bet Group Deleted');

        return redirect()->back();
    }

    public function postSendSms(){
        $request = request();

        session()->flash('success', 'SMS sent');
        return redirect()->back();
    }

    public function getSettings(){
        return view('pages.analyst.settings',[
            'title' => 'Settings',
            'nav'   => 'analyst.settings',
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
