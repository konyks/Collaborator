<?php

namespace Collaborator\Http\Controllers;

use Auth;
use Collaborator\Models\User;
use Collaborator\Models\Group;
use DB;

/**
 * Class HomeController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Get to retrieve user`s dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard(){
        //Get total number of groups
        $total = Group::all()->count();

        //Get number of groups for each specific debarment
        $group_info = DB::table('groups')
            ->select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->paginate(12);

        if (Auth::check()) {
            //determine the number of groups a user is part of
            $user = User::where('username', Auth::user()->getUsername())->first();
            $group_count = $user->groups()->count();

            return view('home.dashboard')
                ->with('departments',$group_info)
                ->with('total', $total)
                ->with('group_count', $group_count);

        }

        return view('home');
    }


    /**
     * Get to retrieve issue reporting form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIssueForm()
    {
        return view('templates.issues');
    }

    /**
     * Get to retrieve feedback form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFeedbackForm()
    {
        return view('templates.feedback');
    }
}
