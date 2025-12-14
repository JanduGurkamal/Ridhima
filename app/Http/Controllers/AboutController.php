<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // About page content can be stored in settings/config
        // For now, we'll use a simple view
        return view('about.index');
    }
}
