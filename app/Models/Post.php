<?php

namespace Collaborator\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Models
 */
class Post extends Model
{
	protected $table = 'posts';

	protected $fillable = [
        'group_id',
        'title',
		'body',
	];

	/**
	 * Get user of a post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('Collaborator\Models\User', 'user_id');
	}

	/**
	 * Get group of a post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function group()
    {
        return $this->belongsTo('Collaborator\Models\Group', 'group_id');
    }

	/**
	 * Get non reply posts (replies to a post)
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeNotReply($query)
	{
		return $query->whereNull('parent_id');
	}

	/**
	 * Get reply for a post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function reply()
	{
		return $this->hasMany('Collaborator\Models\Post', 'parent_id');
	}
}  