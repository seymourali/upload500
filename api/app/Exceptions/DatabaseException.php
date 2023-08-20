<?php

namespace App\Exceptions;

/**
 * Class DatabaseException
 *
 * @package App\Exceptions
 */
class DatabaseException extends BaseException
{
    /**
     * @var int
     */
    protected int $errorCode = 500;
    
    /**
     * DatabaseException constructor
     *
     * @param string $explainErrorMessage
     * @param string $systemErrorMessage
     */
    public function __construct(
        string $explainErrorMessage,
        string $systemErrorMessage
    )
    {
        parent::__construct(
            $explainErrorMessage,
            $this->errorCode,
            $systemErrorMessage,
            self::TYPE_DATABASE_ERROR
        );
    }
}