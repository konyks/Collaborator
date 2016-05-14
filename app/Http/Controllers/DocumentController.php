<?php

namespace Collaborator\Http\Controllers;

use Collaborator\Http\Requests;
use Collaborator\Models\Group;

/**
 * Class DocumentController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class DocumentController extends Controller
{
    /**
     * Get to retrieve all documents for a specific group
     *
     * @param $groupId
     * @return mixed
     */
    public function getIndex($groupId)
    {
        $group = Group::where('id',$groupId)->first();
        $documents = $group->documents()->orderBy('created_at', 'desc')->get();

        return view('documents.index')
            ->with('group', $group)
            ->with('documents', $documents);
    }

}
