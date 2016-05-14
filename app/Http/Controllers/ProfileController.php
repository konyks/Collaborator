<?php

namespace Collaborator\Http\Controllers;

use Auth;
use Collaborator\Models\User;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class ProfileController extends Controller
{
	/**
	 * Get to retrieve user profile
	 *
	 * @param $username
	 * @return mixed
	 */
	public function getProfile($username)
	{
		$user = User::where('username', $username)->first();
		$groups = $user->groups()->paginate(12);

		if(!$user)
		{
			abort(404);
		}

		return view('profile.index')
			->with('user', $user)
			->with('groups', $groups);

	}

	/**
	 * Get to retrieve edit profile form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getEdit()
	{
		return view('profile.edit');
	}

	/**
	 * Get to retrieve get user info form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getUserInfo()
	{
		return view('profile.getuserinfo');
	}

	/**
	 * Post update profile changes
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postEdit(Request $request)
	{
		$this->validate($request, [
			'first_name'=>'alpha|max:50',
			'last_name'=>'alpha|max:50',
			'major'=>'max:50',
			'location'=>'max:20',
			'bio'=>'max:1000',
		]);

		Auth::user()->update([
			'first_name'=>$request->input('first_name'),
			'last_name'=>$request->input('last_name'),
			'major'=>$request->input('major'),
			'location'=>$request->input('location'),
			'bio'=>$request->input('bio'),
		]);
		return redirect()->route('profile.edit')->with('infoAlert','Your profile has been updated.');
	}

	/**
	 * Post to get user information
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function  postUserInfo(Request $request)
	{
		$this->validate($request, [
			'first_name'=>'alpha|max:50',
			'last_name'=>'alpha|max:50',
			'major'=>'max:50',
			'location'=>'max:20',
			'bio'=>'max:1000',
		]);

		Auth::user()->update([
			'first_name'=>$request->input('first_name'),
			'last_name'=>$request->input('last_name'),
			'major'=>$request->input('major'),
			'location'=>$request->input('location'),
			'bio'=>$request->input('bio'),
		]);

		return redirect()->route('home')->with('infoAlert','Start exploring available study groups!');
	}

	/**
	 * Get to retrieve user groups
	 *
	 * @return mixed
	 */
    public function getGroups()
    {
		//Get all groups
        $groups = Auth::user()->groups()->paginate(12);

		//Get groups that user is administrator of
        $adminGroups = Auth::user()->groupsAdmin()->paginate(12);

        return view('profile.groups')
            ->with('groups',$groups)
            ->with('adminGroups', $adminGroups);
    }
}