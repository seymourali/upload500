<?php

namespace App\Http\Requests\Api\Guest\Auth;

use App\Http\Requests\Api\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'email'     => 'required|email',
            'password'  => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'email.required'    => trans('validations/api/guest/auth/login.email.required'),
            'email.email'       => trans('validations/api/guest/auth/login.email.email'),

            'password.required' => trans('validations/api/guest/auth/login.password.required'),
            'password.string'   => trans('validations/api/guest/auth/login.password.string')
        ];
    }
}
