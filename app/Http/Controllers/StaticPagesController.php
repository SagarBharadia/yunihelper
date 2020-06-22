<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function index() {
      	$title = "Home";
      	return view('staticpages.index', compact('title'));
    }
    public function aboutUs() {
    	$title = "About Us";
    	return view('staticpages.aboutus', compact('title'));
    }
    public function whyUseUs() {
        $title = "Why Use Us";
        return view('staticpages.whyuseus', compact('title'));
    }
    public function privacyPolicy() {
        $title = "Privacy Policy";
        return view('staticpages.privacypolicy', compact('title'));
    }
}
