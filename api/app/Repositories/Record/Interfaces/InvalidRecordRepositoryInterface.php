<?php

namespace App\Repositories\Record\Interfaces;

/**
 * Interface InvalidRecordRepositoryInterface
 *
 * @package App\Repositories\Record\Interfaces
 */
interface InvalidRecordRepositoryInterface
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
