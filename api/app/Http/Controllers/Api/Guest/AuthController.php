<?php

namespace App\Http\Controllers\Api\Guest;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Guest\Auth\LoginRequest;
use App\Http\Requests\Api\Guest\Auth\RegisterRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\JsonResponse;

final class AuthController extends BaseController
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * AuthController constructor
     */
    public function __construct()
    {
        /** @var UserRepository userRepository */
        $this->userRepository = new UserRepository();

        parent::__construct();
    }

    /**
     * @param RegisterRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function register(
        RegisterRequest $request
    ) : JsonResponse
    {
        /**
         * Creating user
         */
        $user = $this->userRepository->store(
            $request->input('email'),
            $request->input('password')
        );

        if (!$user) {
            return $this->respondWithError(
                trans('validations/api/guest/auth/register.result.error.create.user')
            );
        }

        return $this->respondWithSuccess([],
            trans('validations/api/guest/auth/register.result.success')
        );
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function login(
        LoginRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user
         */
        $user = $this->userRepository->findByEmail(
            $request->input('email')
        );

        /**
         * Checking user exists
         */
        if (!$user) {
            return $this->respondWithError(
                trans('validations/api/guest/auth/login.result.error.find')
            );
        }

        /**
         * Authorizing user
         */
        if (!auth()->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            return $this->respondWithError(
                trans('validations/api/guest/auth/login.result.error.credentials')
            );
        }

        /**
         * Cteating token
         */
        $token = $user->createToken('Bearer token')->plainTextToken;

        return $this->respondWithSuccess(
            ['access_token' => $token],
            trans('validations/api/guest/auth/login.result.success')
        );
    }
}
