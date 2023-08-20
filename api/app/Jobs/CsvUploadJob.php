<?php

namespace App\Jobs;

use App\Repositories\Record\InvalidRecordRepository;
use App\Repositories\Record\ValidRecordRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exceptions\DatabaseException;

class CsvUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected array $validRows;

    /**
     * @var array
     */
    protected array $invalidRows;

    /**
     * @var ValidRecordRepository
     */
    protected ValidRecordRepository $validRecordRepository;

    /**
     * @var InvalidRecordRepository
     */
    protected InvalidRecordRepository $invalidRecordRepository;

    /**
     * CsvUploadJob constructor.
     * @param array $validRows
     * @param array $invalidRows
     */
    public function __construct(
        array $validRows,
        array $invalidRows
    )
    {
        /** @var ValidRecordRepository validRecordRepository */
        $this->validRecordRepository = new ValidRecordRepository();

        /** @var InvalidRecordRepository invalidRecordRepository */
        $this->invalidRecordRepository = new InvalidRecordRepository();

        $this->validRows = $validRows;
        $this->invalidRows = $invalidRows;
    }

    /**
     * @throws DatabaseException
     */
    public function handle(): void
    {
        $this->validRecordRepository->storeBulk(
            $this->validRows
        );

        $this->invalidRecordRepository->storeBulk(
            $this->invalidRows
        );
    }
}
