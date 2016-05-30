<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Hash;


class UsersController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		return view('changepassword');
	}

	public function getAdd()
    {
    	return view('addadmin');
    }

    public function postAdd(Request $request){
    	$this->validate($request, [
    		'email' => 'required|email',
    		'name' => 'required|max:255',
    	]);
    	$credentials = $request->only('email', 'name');
    	$generate_password = str_random(8);
    	$user = User::create([
    		'name' => $credentials['name'],
    		'email' => $credentials['email'],
    		'password' => bcrypt($generate_password),
    		'key' => 0,
    	]);
    	\Mail::send('emails.welcome', ['user' => $user, 'generate_password' => $generate_password], function ($message) use ($user){
    		$message->from('duylongvnu@gmail.com', "Employee Directory");
    		$message->subject("Welcome to Employee Directory");
    		$message->to($user->email, $user->name);
    	});
        \Session::flash('message1', 'New Administrator has been created successfully !');
    	return redirect('/');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email',
            'password' => 'required',
    		'newpassword' => 'required|confirmed|min:6',
    	]);
    	$credentials = $request->only('email', 'password', 'newpassword', 'newpassword_confirmation');
    	$user = \Auth::user();
        if (Hash::check($credentials['password'], $user->password) && $user->email == $credentials['email']) {
            $user->password = bcrypt($credentials['newpassword']);
            $user->key = 1;
            $user->save();
            \Session::flash('message2', 'Password has been updated successfully !');
            return redirect('/');
        }
        else {
            if ($user->email != $credentials['email']) {
                \Session::flash('message1', 'Email do not match our records');
            }
            if ($user->password != $credentials['password']) {
                \Session::flash('message2', 'old password do not match our records');
            }
        }
        return redirect('/changepassword');
    }
}