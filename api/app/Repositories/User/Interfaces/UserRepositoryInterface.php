<?php

namespace App\Repositories\User\Interfaces;

use App\Models\User;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface
{

    /**
     * This method provides getting row
     * with eloquent model by certain query
     *
     * @param string $email
     *
     * @return User|null
     */
    public function findByEmail(
        string $email
    ) : ?User;

    /**
     * This method provides storing row
     * with eloquent model
     *
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function store(
        string $email,
        string $password
    ) : ? User;

    /**
     * This method provides getting row
     * with eloquent model
     *
     * @param User $user
     * @return User|null
     */
    public function getUserFullProfile(
        User $user
    ) : ?User;
}
