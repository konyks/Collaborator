<?php

namespace Collaborator\Models;

use Collaborator\Models\Post;
use Collaborator\Models\Group;
use Collaborator\Models\Meeting;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Models
 */
class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'major',
        'bio',
        'location',
        'user_pic',
        'first_login',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get name of user
     *
     * @return mixed|null|string
     */
    public function getName()
    {
        if($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }

        if($this->first_name)
        {
            return $this->first_name;
        }

        return null; 
    }

    /**
     * Get username of a user
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get name or user name depending if name exists
     *
     * @return mixed
     */
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    /**
     * Get first name or username depending if name exists
     *
     * @return mixed
     */
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    /**
     * Get email of a user
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get user id of a user
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->id;
    }

    /**
     * Get name of profile picture of a user
     *
     * @return mixed
     */
    public function getAvatarName()
    {
        return $this->user_pic;
    }

    /**
     * Get all group of a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('Collaborator\Models\Group', 'user_group', 'user_id', 'group_id');
    }

    /**
     * Get all meetings of a user
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meetings()
    {
        return $this->belongsToMany('Collaborator\Models\Meeting', 'user_meeting', 'user_id', 'meeting_id');
    }

    /**
     * Get all posts of a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('Collaborator\Models\Post', 'user_id');
    }

    /**
     * Associate a user as a group administrator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupsAdmin()
    {
        return $this->hasMany('Collaborator\Models\Group', 'user_id');
    }

    /**
     * Add group membership for a user
     *
     * @param \Collaborator\Models\Group $group
     */
    public function addGroup(Group $group)
    {
        $this->groups()->attach($group->id);
    }

    /**
     * Cancel group membership for a user
     *
     * @param \Collaborator\Models\Group $group
     */
    public function deleteGroup(Group $group)
    {
        $this->groups()->detach($group->id);
    }

    /**
     * Add meeting attendance for a user
     *
     * @param \Collaborator\Models\Meeting $meeting
     */
    public function addMeeting(Meeting $meeting)
    {
        $this->meetings()->attach($meeting->id);
    }

    /**
     * Cancel meeting attendance for a user
     *
     * @param \Collaborator\Models\Meeting $meeting
     */
    public function deleteMeeting(Meeting $meeting)
    {
        $this->meetings()->detach($meeting->id);
    }

    /**
     * Check if user is in the group
     *
     *
     * @param \Collaborator\Models\Group $group
     * @return int
     */
    public function isInGroup(Group $group)
    {
        return $this->groups()->get()->where('id', $group->id)->count();
    }

    /**
     * Check if user is in a meeting
     *
     * @param \Collaborator\Models\Meeting $meeting
     * @return int
     */
    public function isInMeeting(Meeting $meeting)
    {
        return $this->meetings()->get()->where('id', $meeting->id)->count();
    }

    /**
     * Check if a user is a group administrator
     *
     * @param \Collaborator\Models\Group $group
     * @return mixed
     */
    public function isGroupAdmin(Group $group)
    {
        return $this->groupsAdmin()->get()->where('id', $group->id)->count();
    }
}
