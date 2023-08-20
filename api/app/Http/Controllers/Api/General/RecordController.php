<?php

namespace App\Http\Controllers\Api\General;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\General\Record\ImportRequest;
use App\Jobs\CsvUploadJob;
use App\Repositories\Record\InvalidRecordRepository;
use App\Repositories\Record\ValidRecordRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RecordController extends BaseController
{
    /**
     * @var ValidRecordRepository
     */
    protected ValidRecordRepository $validRecordRepository;

    /**
     * @var InvalidRecordRepository
     */
    protected InvalidRecordRepository $invalidRecordRepository;

    /**
     * RecordController constructor.
     */
    public function __construct()
    {
        /** @var InvalidRecordRepository invalidRecordRepository */
        $this->invalidRecordRepository = new InvalidRecordRepository();

        /** @var ValidRecordRepository validRecordRepository */
        $this->validRecordRepository = new ValidRecordRepository();

        parent::__construct();
    }

    /**
     * @param ImportRequest $request
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function import(
        ImportRequest $request
    ) : JsonResponse
    {

        /**
         * Deleting all valid records of auth user
         */
        /*$this->validRecordRepository->deleteAllRecords(
            Auth::user()
        );*/

        /**
         * Deleting all invalid records of auth user
         */
        $this->invalidRecordRepository->deleteAllRecords(
            Auth::user()
        );

        $validRowsCount = 0;
        $invalidRowsCount = 0;

        $csv = file($request->file('file'));
        $chunks = array_chunk($csv, 1000);

        /** @var array $chunk */
        foreach ($chunks as $chunk) {
            $validRows = [];
            $invalidRows = [];

            /**
             * @var int $key
             * @var string $rowStr
             */
            foreach ($chunk as $key => $rowStr) {
                $rowArr = explode(';', $rowStr);

                foreach ($rowArr as $cell) {
                    if (!$cell || preg_match('/\d/', $cell)) {
                        $invalidRows[] = [
                            'row'     => json_encode($rowArr),
                            'user_id' => Auth::user()->id
                        ];
                        $invalidRowsCount++;
                        break;
                    } else {
                        $validRows[] = [
                            'row'     => json_encode($rowArr),
                            'user_id' => Auth::user()->id
                        ];
                        $validRowsCount++;
                    }
                }
            }

            /**
             * Storing valid/invalid records
             */
            CsvUploadJob::dispatch($validRows, $invalidRows);
        }


        return $this->respondWithSuccess([
                'valid_rows_count'   => $validRowsCount,
                'invalid_rows_count' => $invalidRowsCount,
            ],
            trans('validations/api/general/record/import.result.success')
        );
    }
}
