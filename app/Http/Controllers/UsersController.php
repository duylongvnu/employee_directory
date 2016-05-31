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

    /**
     * Show the form for changing password of the specified user
     *
     * @return \Illuminate\Http\Response
     */
	public function getChange()
	{
		return view('changepassword');
	}

    /** 
     * Update the specified user in storage

     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postChange(Request $request)
    {
        /* Validate for changing password and save the old infomation in a array. */
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'newpassword' => 'required|confirmed|min:6',
        ]);
        $credentials = $request->only('email', 'password', 'newpassword', 'newpassword_confirmation');
        $user = \Auth::user();

        /* Compare new password with old password and new email with old email. If result is true, save the new information of the specified user
        and show the succesfully announce. Else, show the errors announce. */
        if (Hash::check($credentials['password'], $user->password) && $user->email == $credentials['email']) {
            $user->password = bcrypt($credentials['newpassword']);
            $user->key = 1;
            $user->save();
            \Session::flash('message', 'Password has been updated successfully !');
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

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
	public function getAdd()
    {
    	return view('addadmin');
    }

    /**
     * Generate a random password for new user and send infomation to email address.
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAdd(Request $request){
        /* Validate for creating a new user, save the infomation in a array and generate a random password. */
    	$this->validate($request, [
    		'email' => 'required|email',
    		'name' => 'required|max:255',
    	]);
    	$credentials = $request->only('email', 'name');
    	$generate_password = str_random(8);
        $users = User::all();

        /* Check the email address */
        foreach ($users as $user) {
            if ($credentials['email'] == $user->email) {
                \Session::flash('message', 'The email has already been taken.');
                return redirect('addadmin');
            }
        }

        /* Create a new user with the specified infomation */
    	$user = User::create([
    		'name' => $credentials['name'],
    		'email' => $credentials['email'],
    		'password' => bcrypt($generate_password),
    		'key' => 0,
    	]);

        /* Send the information about new user to email address */
    	\Mail::send('emails.welcome', ['user' => $user, 'generate_password' => $generate_password], function ($message) use ($user){
    		$message->from('duylongvnu@gmail.com', "Employee Directory");
    		$message->subject("Welcome to Employee Directory");
    		$message->to($user->email, $user->name);
    	});

        /* Show the succesfully announce */
        \Session::flash('message', 'New Administrator has been created successfully !');
    	return redirect('/');
    }
}