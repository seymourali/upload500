<?php

namespace App\Exceptions;

use Exception;

/**
 * Class BaseException
 * 
 * @package App\Exception
 */
class BaseException extends Exception
{
    /**
     * Exceptions error type constants
     */
    const TYPE_DATABASE_ERROR = 'database_error';
    const TYPE_VALIDATION_ERROR = 'validation_error';
    const TYPE_UNIDENTIFIED_ERROR = 'unidentified_error';

    /**
     * @var string
     */
    protected string $explainErrorMessage;

    /**
     * @var int
     */
    protected int $errorCode;

    /**
     * @var string|null
     */
    protected ?string $systemErrorMessage;

    /**
     * @var string
     */
    protected string $errorAppearance;

    /**
     * @var string
     */
    protected string $errorType;

    public function __construct(
        string $explainErrorMessage,
        int $errorCode,
        ?string $systemErrorMessage = null,
        string $errorType = self::TYPE_UNIDENTIFIED_ERROR
    )
    {
        $this->explainErrorMessage = $explainErrorMessage;
        $this->systemErrorMessage = $systemErrorMessage;
        $this->errorCode = $errorCode;
        $this->errorType = $errorType;

        parent::__construct(
            $explainErrorMessage,
            $errorCode
        );
    }

    /**
     * @return string
     */
    public function getExplainErrorMessage() : string
    {
        return $this->explainErrorMessage;
    }

    /**
     * @return int
     */
    public function getErrorCode() : int
    {
        return $this->errorCode;
    }

    /**
     * @return string|null
     */
    public function getSystemErrorMessage() : ?string
    {
        return $this->systemErrorMessage;
    }

    /**
     * @return string
     */
    public function getErrorType() : string
    {
        return $this->errorType;
    }
}