<?php

namespace App\Http\Requests\Api\Guest\Auth;

use App\Http\Requests\Api\BaseRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|confirmed|min:6'
        ];
    }

    public function messages() : array
    {
        return [
            'email.required'      => trans('validations/api/guest/auth/register.email.required'),
            'email.email'         => trans('validations/api/guest/auth/register.email.email'),
            'email.unique'        => trans('validations/api/guest/auth/register.email.unique'),

            'password.required'   => trans('validations/api/guest/auth/register.password.required'),
            'password.confirmed'  => trans('validations/api/guest/auth/register.password.confirmed'),
            'password.min'        => trans('validations/api/guest/auth/register.password.min')
        ];
    }
}
