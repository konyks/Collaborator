<?php

namespace Collaborator\Http\Controllers;

use DB;
use Collaborator\Models\Group;
use Illuminate\Http\Request;

/**
 * Class SearchController
 *
 * Created by: Serhiy Konyk
 *
 * @package Collaborator\Http\Controllers
 */
class SearchController extends Controller
{
	/**
	 * Get to retrive a search results
	 *
	 *
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function getResults(Request $request)
	{
		$query = $request->input('query');

		if(!$query){
			return redirect()->route('home')->with('infoAlert', 'Please enter something in a search box.');
		}

		$groups = Group::where(DB::raw("CONCAT(name, '', department)"),
			'LIKE', "%{$query}%")->orWhere('name', 'LIKE', "%{$query}%")->get();

		return view('search.results')->with('groups', $groups);
	}
}