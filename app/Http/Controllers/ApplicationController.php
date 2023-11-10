<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function __invoke()
    {   
        return view('admin.layouts.app');
    }
}
