<?php

namespace Collaborator\Http\Controllers;

use Mail;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Collaborator\Models\User;

/**
 * Class AuthController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */

class AuthController extends Controller
{
	/**
	 * Get to retrieve sign up form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getSignup()
	{
		return view('auth.signup');
	}

	/**
	 * Post a user registration
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postSignup(Request $request)
	{


        //Validate the input form a form
		$this->validate($request, [
			'email'=> 'required|unique:users|email|max:255',
			'username'=>'required|unique:users|alpha_dash|max:20', 
			'password'=>'required|min:6|confirmed',
			'password_confirmation'=>'required|min:6',
			]);

        //Update the user table
		User::create([
			'email'=> $request->input('email'), 
			'username'=>$request->input('username'),  
			'password'=>bcrypt($request->input('password')),
            'first_login'=>false,
			'user_pic'=>'default.png',
			]);

		//TODO: find a way to connect a mail server to the heroku account, currently it is not working
        //Sends a welcome email after user successfully registers
//         Mail::send('emails.welcome', ['name'=> Input::get('username')], function($message) {
//             $message->to(Input::get('email'), Input::get('username'))->subject('Welcome to Collaborator');
//
//        });

        //Redirects a user to the home page with a success message           
		return redirect()->route('auth.signin')->with('successAlert','Your account has been created. You can sign in now.');
	}

	/**
	 * Get user sign in screen
	 *
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getSignin()
	{
		return view('auth.signin');
	}

	/**
	 * Post sign in request
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postSignin(Request $request)
	{
		$this->validate($request,[
			'username'=>'required',
			'password'=>'required',
		]);

		if(Auth::attempt($request->only(['username','password']), $request->has('remember')))
		{
            //Check if this is the first login
            if(Auth::user()->first_login == 0)
            {
                //Update first login flag
                Auth::user()->update(['first_login'=>true]);

                //Redirect a user to profile update page
                return redirect()->route('profile.getuserinfo')->with('successAlert','Welcome to Collaborator!');
            }
            else
            {
                //Redirect a user to dashboard
                return redirect()->route('home')->with('successAlert','You are now signed in.');
            }
		}

		return redirect()->back()->with('dangerAlert','Incorrect password or username. Please try again.');

	}

	/**
	 *Get a user sign out request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getSignout()
	{
		Auth::logout();
        
        //Redirects a user back to the home page
		return redirect()->route('home')->with("infoAlert","You have been signed out");
	}

	/**
	 * Retrieve user password change form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function getPasswordChange()
    {
        return view('profile.changepassword');
    }

	/**
	 * Post change password request
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function postPasswordChange(Request $request)
    {
        $this->validate($request,[
            'oldpassword'=>'required|min:6',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6',
        ]);

		//Check if user has entered a correct previous password
        if(!Auth::attempt(['username' => Auth::user()->username, 'password' => $request->input('oldpassword')]))
        {
            return redirect()->back()->with('danger','Your old password did not match records of our system.');
        }

		//Change the password
        Auth::user()->update([
            'password'=>bcrypt($request->input('password')),
        ]);
        return redirect()->back()->with('successAlert','Your password was changed. Make sure now to log in with your new password.');
    }

    /**
     * Redirects a user to a google sign in page
     *
     * @return mixed
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * Handles google callback after sign in
     *
     *
     * @return mixed
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('auth.signup')->with('dangerAlert','You did not authorized Collaborator to access your Google Account. Please register using our registration system.');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        if($authUser->first_login == 0)
        {
            //Update first login flag
            Auth::user()->update(['first_login'=>true]);

            //Redirect a user to profile update page
            return redirect()->route('profile.getuserinfo')->with('successAlert','Welcome to Collaborator!');
        }
        else
        {
            //Redirect a user to dashboard
            return redirect()->route('home')->with('successAlert','You are now signed in.');
        }
    }


    /**
     * Finds a user
     *
     * @param $googleUser
     * @return static
     */
    private function findOrCreateUser($googleUser)
    {
        if ($authUser = User::where('email', $googleUser->email)->first()) {
            return $authUser;
        }
		//Parse email to get username
		$emailParsed = explode('@',$googleUser->email);
		$username = $emailParsed[0];

		//Parse name to get first and last name
		$nameParsed = explode(' ', $googleUser->name);
		$fName = $nameParsed[0];
		$lName = $nameParsed[1];


        return User::create([
            'username' => $username,
            'email' => $googleUser->email,
			'first_name'=>$fName,
			'last_name'=>$lName,
			'first_login'=>false,
			'user_pic'=>'default.png',
        ]);
    }
}