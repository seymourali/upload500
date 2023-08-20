<?php

namespace App\Repositories\Record;

use App\Exceptions\DatabaseException;
use App\Models\User;
use App\Models\ValidRecord;
use App\Repositories\Record\Interfaces\ValidRecordRepositoryInterface;
use Exception;

/**
 * Class ValidRecordRepository
 *
 * @package App\Repositories\Record
 */
class ValidRecordRepository implements ValidRecordRepositoryInterface
{
    /**
     * @param array $data
     * @return bool
     * @throws DatabaseException
     */
    public function storeBulk(
        array $data
    ) : bool
    {
        try {
            return ValidRecord::query()
                ->insert($data);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/validRecord.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param User $user
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteAllRecords(
        User $user
    ) : bool
    {
        try {
            return $user->validRecords()->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/validRecord.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
