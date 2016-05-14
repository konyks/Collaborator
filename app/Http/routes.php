<?php

/**
 * Application Application Routes
 *
 * Created by: Serhiy Konyk
 */

Route::group(['middleware' => ['web']], function () {

	/**
	* HOME ROUTES
	*/
	Route::get('/', [
		'uses' => '\Collaborator\Http\Controllers\HomeController@getDashboard',
		'as' => 'home',
	]);

    Route::get('/issue', [
        'uses' => '\Collaborator\Http\Controllers\HomeController@getIssueForm',
        'as' => 'issue',
    ]);

    Route::get('/feedback', [
        'uses' => '\Collaborator\Http\Controllers\HomeController@getFeedbackForm',
        'as' => 'feedback',
    ]);

	/**
	 * AUTHENTICATION ROUTES
	 */
	Route::get('/signup', [
		'uses' => '\Collaborator\Http\Controllers\AuthController@getSignup',
		'as' => 'auth.signup',
		'middleware' => ['guest'],
		]);

	Route::post('/signup', [
		'uses' => '\Collaborator\Http\Controllers\AuthController@postSignup',
		'middleware' => ['guest'],
		]);

	Route::get('/signin', [
		'uses' => '\Collaborator\Http\Controllers\AuthController@getSignin',
		'as' => 'auth.signin',
		'middleware' => ['guest'],
		]);

	Route::post('/signin', [
		'uses' => '\Collaborator\Http\Controllers\AuthController@postSignin',
		'middleware' => ['guest'],
		]);

	Route::get('/sigout', [
		'uses' => '\Collaborator\Http\Controllers\AuthController@getSignout',
		'as' => 'auth.signout',
		'middleware' => ['auth'],
		]);

    //Temp
    Route::get('auth/google',[
        'uses'=>'\Collaborator\Http\Controllers\AuthController@redirectToProvider',
        'as' => 'google.auth',
    ]);
    Route::get('auth/google/callback',[
        'uses'=>'\Collaborator\Http\Controllers\AuthController@handleProviderCallback',
        'as'=>'google.callback',
    ]);

	/**
	* SEARCH ROUTE
	*/
	Route::get('/search', [
		'uses' => '\Collaborator\Http\Controllers\SearchController@getResults',
		'as' => 'search.results',
		'middleware' => ['auth'],
		]);

	/**
	* USER PROFILE ROTES
	*/
	Route::get('/user/{username}', [
		'uses' => '\Collaborator\Http\Controllers\ProfileController@getProfile',
		'as' => 'profile.index',
		'middleware' => ['auth'],
		]);

	Route::get('/profile/edit', [
		'uses' => '\Collaborator\Http\Controllers\ProfileController@getEdit',
		'as' => 'profile.edit',
		'middleware' => ['auth'],
		]);

	Route::post('/profile/edit', [
		'uses' => '\Collaborator\Http\Controllers\ProfileController@postEdit',
		'middleware' => ['auth'],
		]);

	Route::get('/profile/getuserinfo', [
		'uses' => '\Collaborator\Http\Controllers\ProfileController@getUserInfo',
		'as' => 'profile.getuserinfo',
		'middleware' => ['auth'],
	]);

	Route::post('/profile/getuserinfo', [
		'uses' => '\Collaborator\Http\Controllers\ProfileController@postUserInfo',
		'middleware' => ['auth'],
	]);

	Route::post('/avatar/edit',[
		'uses' => '\Collaborator\Http\Controllers\UploadController@editAvatar',
		'as' => 'avatar.edit',
		'middleware' => ['auth'],
	]);
    Route::post('/avatar/upload',[
        'uses' => '\Collaborator\Http\Controllers\UploadController@uploadAvatar',
        'as' => 'avatar.upload',
        'middleware' => ['auth'],
    ]);
	Route::get('/profile/changepassword', [
		'uses' => '\Collaborator\Http\Controllers\AuthController@getPasswordChange',
		'as' => 'profile.changepassword',
		'middleware' => ['auth'],
	]);

	Route::post('/profile/changepassword',[
		'uses' => '\Collaborator\Http\Controllers\AuthController@postPasswordChange',
		'as' => 'profile.changepassword',
		'middleware' => ['auth'],
	]);

    Route::get('/profile/groups', [
        'uses' => '\Collaborator\Http\Controllers\ProfileController@getGroups',
        'as' => 'profile.groups',
        'middleware' => ['auth'],
    ]);

	/**
	 * GROUP ROUTES
	 */

    Route::get('/group/create', [
        'uses' => '\Collaborator\Http\Controllers\GroupController@getCreate',
        'as' => 'group.create',
        'middleware' => ['auth'],
    ]);

    Route::post('/group/create', [
        'uses' => '\Collaborator\Http\Controllers\GroupController@postCreate',
        'middleware' => ['auth'],
    ]);

    Route::get('/groups',[
        'uses' => '\Collaborator\Http\Controllers\GroupController@getAllGroups',
        'as' => 'group.index',
        'middleware' => ['auth'],
    ]);

    Route::get('/group/{groupId}', [
        'uses' => '\Collaborator\Http\Controllers\GroupController@getGroupProfile',
        'as' => 'group.profile',
        'middleware' => ['auth'],
    ]);

    Route::get('/group/update/{groupId}', [
        'uses' => '\Collaborator\Http\Controllers\GroupController@getGroupUpdateProfile',
        'as' => 'group.edit',
        'middleware' => ['auth'],
    ]);

    Route::post('/group/update', [
        'uses' => '\Collaborator\Http\Controllers\GroupController@postGroupUpdateProfile',
        'as'=>'group.update',
        'middleware' => ['auth'],
    ]);

	Route::get('/group/department/{department}',[
		'uses' => '\Collaborator\Http\Controllers\GroupController@getDepartmentGroups',
		'as'=>'group.departmentgroup',
		'middleware'=>['auth'],
	]);

	/**
	 * GROUP MEMBERSHIP ROTES
	 */

    Route::get('/group/add/{groupId}',[
        'uses' => '\Collaborator\Http\Controllers\MembershipController@postAdd',
        'as' => 'group.add',
        'middleware' => ['auth'],
    ]);

    Route::get('/group/delete/{groupId}',[
        'uses' => '\Collaborator\Http\Controllers\MembershipController@postDelete',
        'as' => 'group.delete',
        'middleware' => ['auth'],
    ]);

	/**
	 * DISCUSSION ROUTES
	 */
	Route::get('/group/discussion/timeline/{groupId}', [
		'uses'=>'\Collaborator\Http\Controllers\PostController@getDiscussionTimeline',
		'as' => 'discussion.timeline',
		'middleware' => ['auth'],
	]);

	Route::get('/group/discussion/{groupId}',[
		'uses' => '\Collaborator\Http\Controllers\PostController@getDiscussion',
		'as' => 'discussion.postcreate',
		'middleware' => ['auth'],
	]);

	Route::post('/group/discussion/create', [
		'uses' => '\Collaborator\Http\Controllers\PostController@postDiscussion',
		'as' => 'discussion.post',
		'middleware' => ['auth'],
	]);

	Route::post('/group/discussion/{statusId}/reply', [
		'uses' => '\Collaborator\Http\Controllers\PostController@postReply',
		'as' => 'post.reply',
		'middleware' => ['auth'],
	]);

	/**
	 * MEETINGS ROUTES
	 */
    Route::get('/group/meeting/{groupId}', [
        'uses'=>'\Collaborator\Http\Controllers\MeetingController@getScheduler',
        'as' => 'meetings.index',
        'middleware' => ['auth'],
    ]);

    Route::post('/group/meeting/create', [
        'uses'=>'\Collaborator\Http\Controllers\MeetingController@postMeeting',
        'as' => 'meetings.create',
        'middleware' => ['auth'],
    ]);

	Route::get('/group/meeting/confirm/{meetingId}',[
		'uses' => '\Collaborator\Http\Controllers\MeetingController@postConfirmMeeting',
		'as' => 'meeting.confirm',
		'middleware' => ['auth'],
	]);

    Route::get('/group/meeting/decline/{meetingId}',[
        'uses' => '\Collaborator\Http\Controllers\MeetingController@postDeclineMeeting',
        'as' => 'meeting.decline',
        'middleware' => ['auth'],
    ]);

    /**
     * DOCUMENTS ROUTES
     */
    Route::get('/group/documents/{groupId}', [
        'uses'=>'\Collaborator\Http\Controllers\DocumentController@getIndex',
        'as' => 'documents.index',
        'middleware' => ['auth'],
    ]);

	Route::post('/group/document/upload',[
		'uses' => '\Collaborator\Http\Controllers\UploadController@uploadDocument',
		'as' => 'document.upload',
		'middleware' => ['auth'],
	]);
});

