<?php

namespace Collaborator\Http\Controllers;

use Collaborator\Http\Requests;
use Collaborator\Models\Document;
use Collaborator\Models\User;
use Auth;
use Redirect;
use Illuminate\Http\Request;

/**
 * Class UploadController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class UploadController extends Controller {

    /**
     * Post to upload user profile picture
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function uploadAvatar(Request $request) {

        //Validate the input form a form
        $this->validate($request, [
            'image'=>'required',
        ]);

        if ($request->file('image')->isValid()) {
            $this->uploadPicture($request);

            return redirect()->route('profile.getuserinfo')->with('successAlert', 'Your profile picture was uploaded.');
        }
        else {
            return redirect()->route('profile.getuserinfo')->with('dangerAlert', 'Your profile picture was not uploaded.');
        }
    }

    /**
     * Post to edit avatar
     *
     * @param Request $request
     * @return mixed
     */
    public function editAvatar(Request $request) {

        //Validate the input form a form
        $this->validate($request, [
            'image'=>'required',
        ]);

        if ($request->file('image')->isValid()) {
            $this->uploadPicture($request);

            return redirect()->route('profile.edit')->with('successAlert', 'Your profile picture was updated.');
        }
        else {
            return redirect()->route('profile.edit')->with('dangerAlert', 'Your profile picture was not updated.');
        }
    }

    /**
     * Upload picture to a server
     *
     * @param Request $request
     */
    private function uploadPicture(Request $request)
    {
        $destinationPath = public_path().'/avatars';

        $extension = $request->file('image')->getClientOriginalExtension();

        $fileName = Auth::user()->getUsername().'.'.$extension;

        // find user and update user_pic field
        $user_id = Auth::user()->getUserId();
        $user = User::find($user_id);
        $user->user_pic = $fileName;
        $user->save();

        $request->file('image')->move($destinationPath, $fileName);
    }


    /**
     * Post to upload document for a group
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function uploadDocument(Request $request) {

        //Validate the input form a form
        $this->validate($request, [
            'title'=>'required',
            'document'=>'required',
        ]);

        //Get group`s id
        $group_id = $request->input('group_id');

        if ($request->file('document')->isValid()) {

            $destinationPath = public_path().'/documents';

            $extension = $request->file('document')->getClientOriginalExtension();

            if($extension != 'pdf')
            {
                return redirect()->route('documents.index', ['groupId'=>$group_id])->with('dangerAlert', 'Upload only pdf documents for better viewer experience Please try again.');
            }
            else
            {
                $title = $request->input('title');

                $user_id = Auth::user()->getUserId();

                $fileName = $group_id.'_'.$title.'.'.$extension;

                //Update the user table
                Document::create([
                    'group_id'=> $group_id,
                    'user_id'=>$user_id,
                    'title'=>$title,
                    'path'=>$fileName,
                ]);


                $request->file('document')->move($destinationPath, $fileName);

                return redirect()->route('documents.index', ['groupId'=>$group_id])->with('successAlert', 'The document was uploaded successfully.');
            }
        }
        else {
            return redirect()->route('documents.index', ['groupId'=>$group_id])->with('dangerAlert', 'Sorry, some kind of error happened. Stay patient.');
        }
    }

}