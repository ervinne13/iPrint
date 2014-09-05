<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TestController extends Controller {

    public function getNotifier() {
        return view('pages.test.notifier');
    }

    public function getLayout() {
        return view('layouts.lte');
    }

    public function getRandom() {
        return str_random(60);
    }

    public function testApi() {
        return Auth::guard('api')->user();
    }

}
