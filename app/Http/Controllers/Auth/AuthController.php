<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name'     => 'required|max:255',
                    'email'    => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'name'      => $data['name'],
                    'email'     => $data['email'],
                    'api_token' => str_random(60),
                    'password'  => \Hash::make($data['password']),
        ]);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles) {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended($this->customRedirectPath());
//        return redirect()->intended('/test');
    }

    public function customRedirectPath() {
        $user = Auth::user();

        if ($user->role_code == Role::CODE_ADMIN) {
            return "/administration";
        } else if ($user->role_code == Role::CODE_USER) {
            return "/users/dashboard";
        } else {
            return "/stores/" . $user->ownedShop->id;
        }
    }

    /**
     * For testing only
     * @param Request $request
     */
    public function clearThrottle(Request $request) {
        $this->clearLoginAttempts($request);
        return "Throttles cleared";
    }

}
