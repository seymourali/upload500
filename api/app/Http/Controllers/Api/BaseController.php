<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\Response\ApiResponseTrait;

/**
 * class BaseController
 *
 * @package App\Http\Controllers\Api
 */
abstract class BaseController extends Controller
{
    use ApiResponseTrait;

    /**
     * BaseController constructor
     */
    public function __construct ()
    {
        //return auth('api')->user();
    }
}
