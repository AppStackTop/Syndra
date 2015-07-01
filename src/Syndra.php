<?php namespace Laravelista\Syndra;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Syndra {

    /**
     * Default is (200).
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return mixed
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Responds with JSON, status code and headers.
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data)
    {
        return new JsonResponse($data, $this->getStatusCode(), $this->getHeaders());
    }

    /**
     * Use this for responding with messages.
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithMessage($message)
    {
        return $this->respond([
            'message'     => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }

    /**
     * Use this for responding with error messages.
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message'     => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Use this to respond with a message (200).
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondOk($message)
    {
        return $this->setStatusCode(Response::HTTP_OK)
            ->respondWithMessage($message);
    }

    /**
     * Use this when a resource has been created (201).
     *
     * @param $message
     * @return mixed
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(Response::HTTP_CREATED)
            ->respondWithMessage($message);
    }

    /**
     * Use this when a resource has been updated (202).
     *
     * @param $message
     * @return mixed
     */
    public function respondUpdated($message)
    {
        return $this->setStatusCode(Response::HTTP_ACCEPTED)
            ->respondWithMessage($message);
    }

    /**
     * Use this when a resource is not found (404).
     *
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message)
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    /**
     * Use this for general server errors (500).
     *
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message)
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
    }

    /**
     * Use this when the validation fails (422).
     *
     * @param string $message
     * @return mixed
     */
    public function respondValidationError($message)
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError($message);
    }

    /**
     * Use this when the user does not have permission to do something (403).
     *
     * @param string $message
     * @return mixed
     */
    public function respondForbidden($message)
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)
            ->respondWithError($message);
    }

    /**
     * Use this when the user needs to be authorized to do something.
     *
     * @param $message
     * @return mixed
     */
    public function respondUnauthorized($message)
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)
            ->respondWithError($message);
    }

}