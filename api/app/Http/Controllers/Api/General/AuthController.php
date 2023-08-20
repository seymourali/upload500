<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;

final class AuthController extends BaseController
{
    /**
     * AuthController constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*public function getAuthUser(
        GetAuthSellerRequest $request
    )
    {

        $seller = $this->sellerRepository->getSeller(
            auth()->guard('seller-api')->user()
        );


        if (!$seller) {
            return $this->respondWithError(
                trans('validations/api/seller/auth/getAuthSeller.result.error.find')
            );
        }

        return (new SellerResource($seller))->additional([
            'message' => trans('validations/api/seller/auth/getAuthSeller.result.success')
        ]);
    }*/

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->guard('api')->user()->tokens()->delete();

        return $this->respondWithSuccess([],
            trans('validations/api/general/auth/logout.result.success')
        );
    }
}
