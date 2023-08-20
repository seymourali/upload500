<?php

namespace App\Repositories\Record\Interfaces;

/**
 * Interface ValidRecordRepositoryInterface
 *
 * @package App\Repositories\Record\Interfaces
 */
interface ValidRecordRepositoryInterface
{
    /**
     * Storing multiple records
     *
     * @param array $data
     * @return bool
     */
    public function storeBulk(
        array $data
    ) : bool;
}
