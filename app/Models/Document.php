<?php

namespace Collaborator\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Meeting
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Models
 */
class Document extends Model
{
    protected $table = 'documents';

    protected $fillable = [
        'group_id',
        'user_id',
        'title',
        'path',
    ];

    /**
     * Get user of a specific document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Collaborator\Models\User', 'user_id');
    }
}
