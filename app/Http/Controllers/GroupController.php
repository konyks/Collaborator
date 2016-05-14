<?php

namespace Collaborator\Http\Controllers;

use Illuminate\Http\Request;
use Collaborator\Models\Group;
use Auth;
use DB;

/**
 * Class GroupController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class GroupController extends Controller
{
    /**
     * Get create group form
     *
     * @return $this
     */
    public function getCreate()
    {
        //All academic departments
        $departments = array("Automotive Tech", "Anthropology", "Arabic","Architectural Technology","Art History","Aviation","Computer Systems","Biology","Business","Chinese","Chemistry","Construction","Criminal Justice","Dental Hygiene","Economics","Electrical Engineering","English","Environmental Studies","ESL","French","Freshman Experience","Geography","German","History","Horticulture","Health Studies","Industrial Technology","Italian","Mechanical Engineering","Modern Languages","Medical Technology","Mathematics","Nursing","Professional Communications","Physical Education","Philosophy","Physics","Politics","Psychology","Software Technology","Sport Management","Sociology","Spanish","Speech","Science and Tech","Telecommunications","Theatre","Visual Communications");
        return view('group.create')
            ->with('departments', $departments);
    }

    /**
     * Post new group request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        //Validate the input for a form
        $this->validate($request, [
            'name'=> 'required',
            'department'=>'required',
            'description'=>'required',
        ]);

        //Update groups table
        $group = Group::create([
            'user_id'=> Auth::user()->getUserId(),
            'name'=> $request->input('name'),
            'department'=>$request->input('department'),
            'description'=>$request->input('description'),
        ]);
        //Add to the group
        Auth::user()->addGroup($group);

        //Redirects a user to the dashboard with a success message
        return redirect()->route('group.profile', ['groupID' => $group->id])->with('successAlert','Group was created. Start Exploring!');

    }

    /**
     * Get to retrieve all groups
     *
     * @return $this
     */
    public function getAllGroups()
    {

        $groups = Group::orderBy('department', 'desc')->paginate(30);

        return view('group.index')
            ->with('groups', $groups);
    }

    /**
     * Get to retrieve all groups for a specific debarment
     *
     *
     * @param $department
     * @return mixed
     */
    public function getDepartmentGroups($department)
    {
        $groups = Group::where('department',$department)->get();

        return view('group.departmentgroup')
                ->with('department', $department)
                ->with('groups', $groups);
    }

    /**
     * Get to retrieve a group profile
     *
     * @param $groupId
     * @return mixed
     */
    public function getGroupProfile($groupId)
    {
        $group = Group::where('id',$groupId)->first();

        if(!$group)
        {
            abort(404);
        }

        $users = $group->users()->get();

        return view('group.profile')
            ->with('group',$group)
            ->with('users',$users);
    }

    /**
     * Get to retrieve group update form
     *
     * @param $groupId
     * @return $this
     */
    public function getGroupUpdateProfile($groupId)
    {
        $group = Group::where('id',$groupId)->first();

        if(!$group)
        {
            abort(404);
        }
        return view('group.edit')
            ->with('group',$group);

    }

    /**
     * Post to update group profile
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public  function postGroupUpdateProfile(Request $request)
    {
        //Validate the input form a form
        $this->validate($request, [
            'name'=> 'required',
            'description'=>'required',
        ]);

        //Get the group filtered by id
        $group = Group::where('id', $request->input('groupId'))->first();

        //Update according to the request
        $group->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
        ]);

        //Redirect back to with a success message
        return redirect()->back()->with('infoAlert','Your profile has been updated.');
    }

}
