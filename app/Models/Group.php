<?php

namespace Collaborator\Models;

use Illuminate\Database\Eloquent\Model;
use Collaborator\Models\Post;
use Collaborator\Models\Meeting;

/**
 * Class Group
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Models
 */
class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',
        'user_id',
        'department',
        'description',
    ];

    /**
     * Get name of a group
     *
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->name;
    }

    /**
     * Get department of a group
     *
     * @return mixed
     */
    public function getDepartmentName()
    {
        return $this->department;
    }

    /**
     * Get all users of a group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Collaborator\Models\User', 'user_group', 'group_id', 'user_id');
    }

    /**
     * Get all posts of a group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('Collaborator\Models\Post', 'group_id');
    }

    /**
     * Get all documents of a group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany('Collaborator\Models\Document', 'group_id');
    }

    /**
     * Get all meetings of a group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meetings()
    {
        return $this->hasMany('Collaborator\Models\Meeting', 'group_id');
    }

}
