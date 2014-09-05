<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        //  only the current user may change its own password
        $currentUser = Auth::user();
        $userId      = $this->route('userId');
        return $currentUser->id == $userId;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'password_old' => 'required|min:6',
            'password'     => 'required|min:6|confirmed',
        ];
    }

}
