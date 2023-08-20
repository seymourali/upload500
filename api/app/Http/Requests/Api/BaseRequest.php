<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Support\Response\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class BaseRequest
 *
 * @package App\Http\Requests\Api
 */
abstract class BaseRequest extends Request
{
    use ApiResponseTrait;

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $plainErrorsArray = [];
        foreach ($validator->errors()->getMessages() as $key => $errorMessages) {
            foreach ($errorMessages as $errorMessage) {
                $plainErrorsArray[$key][] = $errorMessage;
            }
        }

        throw new HttpResponseException(
            $this->respondWithValidationError($plainErrorsArray)
        );
    }

    /**
     * @param null $keys
     *
     * @return array
     */
    public function all($keys = null) : array
    {
        return array_merge(
            parent::all(),
            $this->route()->parameters()
        );
    }
}
