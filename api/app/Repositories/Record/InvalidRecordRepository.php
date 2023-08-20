<?php

namespace App\Repositories\Record;

use App\Exceptions\DatabaseException;
use App\Models\InvalidRecord;
use App\Models\User;
use App\Repositories\Record\Interfaces\InvalidRecordRepositoryInterface;
use Exception;

/**
 * Class InvalidRecordRepository
 *
 * @package App\Repositories\Record
 */
class InvalidRecordRepository implements InvalidRecordRepositoryInterface
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
            return InvalidRecord::query()
                ->insert($data);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/invalidRecord.' . __FUNCTION__),
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
    ) : void
    {
        //try {
            $user->invalidRecords()->delete();
        /*} catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/invalidRecord.' . __FUNCTION__),
                $exception->getMessage()
            );
        }*/
    }
}
