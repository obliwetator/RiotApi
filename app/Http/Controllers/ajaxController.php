<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ajaxController extends Controller
{
	public function Summoner(Request $request)
	{
		
		$name = $request->all();
		dd($name);
		return view('summonerAjax');
	}
}
