<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends \App\Http\Controllers\Controller {

    use \Illuminate\Foundation\Auth\ThrottlesLogins;

    public function login(Request $request) {

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only('email', 'password');        
        
//        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
//            $this->incrementLoginAttempts($request);
        }

        return response("These credentials do not match our records.", 400);
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait() {
        return in_array(
                ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles) {

        return Auth::user()->withHidden('api_token');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard() {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

}
