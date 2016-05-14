<?php

namespace Collaborator\Models;

use Illuminate\Database\Eloquent\Model;
use Collaborator\Models\Group;

/**
 * Class Meeting
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Models
 */
class Meeting extends Model
{
    protected $fillable = [
        'group_id',
        'time',
        'location',
        ];

    /**
     * Get group for a meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('Collaborator\Models\Group', 'group_id');
    }

    /**
     * Get meeting attendees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Collaborator\Models\User', 'user_meeting', 'meeting_id', 'user_id');
    }
}
