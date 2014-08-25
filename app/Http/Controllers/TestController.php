<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class TestController extends Controller {

    public function getNotifier() {
        return view('pages.test.notifier');
    }

    public function getLayout() {
        return view('layouts.lte');
    }
    
}
