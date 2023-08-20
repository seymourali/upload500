<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use Exception;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

/**
 * Class UserRepository
 *
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return User|null
     */
    public function findByEmail(
        string $email
    ) : ?User
    {
        try {
            return User::query()
                ->where('email', '=', trim($email))
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return User|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $email,
        string $password
    ) : ? User
    {
        try {
            return User::create([
                'email'     => $email,
                'password'  => Hash::make(trim($password))
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param User $user
     * @return User|null
     *
     * @throws DatabaseException
     */
    public function getUserFullProfile(
        User $user
    ) : ?User
    {
        if ($this->caching === false) {
            if (method_exists($this, 'clearCache')) {
                $this->clearCache(
                    __FUNCTION__,
                    $user
                );
            }
        }

        try {
            return Cache::remember('users.' . $user->id . '.fullProfile', $this->cacheTime,
                function () use ($user) {
                    return User::query()
                        ->select([
                            'id',
                            'email',
                            'first_name',
                            'last_name',
                            'birth_date',
                            'phone'
                        ])
                        ->with([
                            'orders' => function ($query) {
                                $query->select([
                                    'id',
                                    'user_id',
                                    'summary',
                                    'payment_type_id',
                                    'date',
                                    'time_range_id',
                                    'comment',
                                    'address_id',
                                    'status_id',
                                    'payment_status_id'
                                ])
                                ->with([
                                    'orderItems'
                                ]);
                            },
                            'addresses' => function ($query) {
                                $query->select([
                                    'id',
                                    'user_id',
                                    'city_id',
                                    'area_id',
                                    'name',
                                    'first_name',
                                    'last_name',
                                    'phone',
                                    'email',
                                    'text'
                                ])
                                ->with([
                                    'city' => function ($query) {
                                        $query->select([
                                            'id',
                                            'name',
                                            'code'
                                        ])
                                        ->with([
                                            'timeRanges' => function ($query) {
                                                $query->select([
                                                    'id',
                                                    'start',
                                                    'end'
                                                ]);
                                            }
                                        ]);
                                    },
                                    'area' => function ($query) {
                                        $query->select([
                                            'id',
                                            'name',
                                            'code'
                                        ])
                                        ->with([
                                            'timeRanges' => function ($query) {
                                                $query->select([
                                                    'id',
                                                    'start',
                                                    'end'
                                                ]);
                                            }
                                        ]);
                                    }
                                ]);
                            }

                        ])
                        ->where('id', '=', $user->id)
                        ->first();
                }
            );
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
