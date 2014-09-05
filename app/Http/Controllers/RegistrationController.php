<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RegistrationController extends Controller {

    public function registerUser(RegisterUserRequest $request) {

        $requestAssoc = $request->toArray();

        try {
            $user            = new User($requestAssoc);
            $user->password  = \Hash::make($request->password);
            $user->role_code = Role::CODE_USER;
            $user->api_token = str_random(60);

            $user->save();

            return redirect('/users/dashboard');
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function registerStore(Request $request) {

        return $request;
    }

}
