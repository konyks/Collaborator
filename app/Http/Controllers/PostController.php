<?php

namespace Collaborator\Http\Controllers;

use Auth;
use Collaborator\Models\Post;
use Collaborator\Models\Group;
use Illuminate\Http\Request;

/**
 * Class PostController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Models
 */
class PostController extends Controller
{
	/**
	 * Post group discussion thread
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDiscussion(Request $request)
	{
		$this->validate($request, [
			'title'=>'required',
			'body' => 'required|max:10000',
			]);


		Auth::user()->posts()->create([
            'title'=>$request->input('title'),
			'body' =>$request->input('body'),
            'group_id'=>$request->input('group_id'),
			]);

		return redirect()->route('discussion.timeline', ['groupId'=>$request->input('group_id')])->with('successAlert','Discussion was posted.');
	}

	/**
	 * Post reply to group discussion thread
	 *
	 *
	 * @param Request $request
	 * @param $postId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postReply(Request $request, $postId)
	{
		$this->validate($request, [
			"reply-{$postId}"=>'required|max:1000',

			],
			[
				'required'=>'The reply body is required.'
			]);

		$post = Post::notReply()->find($postId);

		if (!$post) {
			return redirect()->route('home');
		}

		$reply = Post::create([
			'body'=>$request->input("reply-{$postId}"),
			'group_id'=>$request->input('group_id'),
		])->user()->associate(Auth::user());

		$post->reply()->save($reply);

		return redirect()->back();
	}

	/**
	 * Get to retrieve group discussion threads
	 *
	 * @param $groupId
	 * @return mixed
	 */
    public function getDiscussionTimeline($groupId)
    {
        $group = Group::where('id',$groupId)->first();

        if(!$group)
        {
            abort(404);
        }

        $posts = Post::notReply()->where('group_id', $groupId)->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('discussion.timeline')
            ->with('posts', $posts)
            ->with('group',$group);
    }
}