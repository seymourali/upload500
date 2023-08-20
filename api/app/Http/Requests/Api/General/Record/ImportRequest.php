<?php

namespace App\Http\Requests\Api\General\Record;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class ImportRequest
 *
 * @package App\Http\Requests\Api\Record
 */
class ImportRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'file'  => 'required|mimes:csv,txt|max:500000'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'file.required'  => trans('validations/api/record/import.file.required'),
            'file.mimes'     => trans('validations/api/record/import.file.mimes'),
            'file.max'       => trans('validations/api/record/import.file.max')
        ];
    }
}
