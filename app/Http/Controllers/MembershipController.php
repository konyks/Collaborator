<?php

namespace Collaborator\Http\Controllers;

use Auth;
use Collaborator\Models\Group;
use Collaborator\Http\Requests;

/**
 * Class MembershipController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class MembershipController extends Controller
{
    /**
     * Post to get group membership
     *
     * @param $groupId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd($groupId)
    {
        $group = Group::find($groupId);

        if(!$group)
        {
            return redirect()
                ->route('home')
                ->withWarning('That group could not be found');
        }
        elseif(Auth::user()->isInGroup($group))
        {
            return redirect()->route('group.profile', ['groupId'=>$group->id])
                ->with('dangerAlert', 'You are already a member of this group');
        }
        else{
            Auth::user()->addGroup($group);

            return redirect()
                ->route('group.profile', ['groupId'=>$group->id])
                ->with('successAlert', 'You have joined '.$group->name.' study group.');
        }

    }

    /**
     * Post to cancel group membership
     *
     *
     * @param $groupId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($groupId)
    {
        $group = Group::find($groupId);

        if(!Auth::user()->isInGroup($group))
        {
            return redirect()->back();
        }

        Auth::user()->deleteGroup($group);

        return redirect()->back()->with('successAlert', 'You are no longer a part of '.$group->name.' study group. Remember that you can always join us again.');
    }

}
