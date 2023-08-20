<?php

namespace App\Support\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;
use stdClass;

trait ApiResponseTrait 
{
    /** @var int */
    private int $statusCode = 200;

    /** @var array|null */
    private ?array $pagination = null;
    
    /**
     * @param $message
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError(string $message = null) 
    {
        return $this->respondRawError($message);
    }

    private function respondRawError($data, int $statusCode = 400)
    {
        if (is_string($data)) {
            $responseBody = [
                'errors' => []
            ];

            if ($data !== null) {
                $responseBody['errors']['message'] = $data;
            }

            if (empty($responseBody['errors'])) {
                $responseBody['errors'] = new stdClass;
            }
        } elseif (is_array($data)) {
            $responseBody = [
                'errors' => $data
            ];
        } else {
            $responseBody = [
                'errors' => [
                    'message' => 'Uknown error.'
                ]
            ];
        }

        return $this->setStatusCode($statusCode)
            ->respond($responseBody);
    }

    /**
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function respond($data = [], $headers = [])
    {
        return response()->json(
            $data,
            $this->getStatusCode(),
            $headers,
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * @param array|null $data
     * @param string|null $message
     *
     * @return JsonResponse
     */
    protected function respondWithSuccess(
        array $data = null,
        string $message = null
    ) : JsonResponse 
    {
        $responseBody = $data !== null ? $data : [];
        if ($message !== null) {
            $responseBody['message'] = $message;
        }
        if ($this->pagination !== null) {
            $responseBody['pagination'] = $this->pagination;
            $this->pagination = null;
        }
        if (empty($responseBody)) {
            $responseBody = new stdClass;
        }

        return $this->respond($responseBody);
    }

    /**
     * @param array $messages
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithValidationError(array $messages) 
    {
        return $this->respondRawError($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return int
     */
    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * 
     * @return $this
     */
    protected function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}