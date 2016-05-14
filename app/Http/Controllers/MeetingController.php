<?php

namespace Collaborator\Http\Controllers;

use Carbon\Carbon;
use Auth;
use Collaborator\Models\Meeting;
use Collaborator\Models\Group;
use Collaborator\Http\Requests;
use Illuminate\Http\Request;
use Collaborator\Repositories\MeetingRepository;
/**
 * Class MeetingController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class MeetingController extends Controller
{
    /**
     * Get to retrieve group`s meetings
     *
     *
     * @param $groupId
     * @return mixed
     */
    public function getScheduler($groupId)
    {
        $group = Group::where('id', $groupId)->first();
        $meetings = $group->meetings()->orderBy('time', 'desc')->get();
        return view('meetings.index')
            ->with('group', $group)
            ->with('meetings', $meetings);
    }

    /**
     * Post to schedule a new meeting
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMeeting(Request $request)
    {
        $this->validate($request, [
            'time' => 'required',
            'location' => 'required',
        ]);

        //Parse time into a DATETIME format
        $time = Carbon::parse($request->time)->toDateTimeString();

        Meeting::create([
            'group_id' => $request->group_id,
            'time' => $time,
            'location' => $request->location,
        ]);

        $id = $request->group_id;

        return redirect()->route('meetings.index', ['groupId' => $id])->with('successAlert','Meeting was scheduled for the group!');
    }

    /**
     * Post to confirm meeting attendance
     *
     * @param $meetingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postConfirmMeeting($meetingId)
    {
        $meeting = Meeting::find($meetingId);

        if(!$meeting)
        {
            return redirect()
                ->route('home')
                ->withWarning('That meeting could not be found');
        }
        else{
            Auth::user()->addMeeting($meeting);

            return redirect()
                ->back()
                ->with('successAlert', 'You have confirmed the attendance.');
        }
    }

    /**
     * Post to decline meeting attendance
     *
     *
     * @param $meetingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeclineMeeting($meetingId)
    {
        $meeting = Meeting::find($meetingId);

        if(!$meeting)
        {
            return redirect()
                ->route('home')
                ->withWarning('That meeting could not be found');
        }
        else{
            Auth::user()->deleteMeeting($meeting);

            return redirect()
                ->back()
                ->with('dangerAlert', 'You have declined the attendance.');
        }
    }
}
