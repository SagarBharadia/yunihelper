<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileSettingsRequest;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
	public function index() {
		$title = "Settings";
		return view('dashboard.settings.index', compact('title'));
	}
	public function updateProfileSettings(UpdateProfileSettingsRequest $request) {
		DB::table('users')->where('id', '=', auth()->user()->id)->update(
			['firstname' => request('firstname')],
			['lastname' => request('lastname')]
		);
		return redirect()->route('settings')->with('message', 'Profile Settings updated.');
	}
}
