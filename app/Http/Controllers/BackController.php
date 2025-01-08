<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{SubscriptionType, Subscription, User};

use \Carbon\Carbon;

class BackController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->_date = Carbon::now();
    }

    public function dashboard(){
        $user = auth()->user();

        if($user->is_admin()){
            return redirect()->route('admin.dashboard');
        }
        
        elseif($user->is_standard_user()){
            return redirect()->route('standard-user.dashboard');
        }

        elseif($user->is_analyst()){
            return redirect()->route('analyst.dashboard');
        }

        else{
            auth()->logout();
            return redirect()->route('login');
        }
    }

    public function postUpdatePassword(){
        $request = request();
        $user = auth()->user();

        $this->validate($request, [
            'old_password'  => 'required|max:191',
            'new_password'  => 'required|min:8|max:191|confirmed',
        ]);

        if(\Hash::check(request('old_password'), $user->password)){
    		$user->password = bcrypt(request('new_password'));
	    	$user->update();

	    	session()->flash('success', 'Password Updated');
    	}else{
			session()->flash('error', 'The old password is incorrect');
    	}

    	return redirect()->back();
    }
}
