<?php

namespace App\Service;

use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class ServiceResponse
 * @use Make a response for a service
 * @package App\Service
 */
class ServiceResponse
{
    const NO_ID_MESSAGE = "return id should be null";
    const NO_RESPONSE_MESSAGE = "No response for this query, try with other param";
    /**
     * @var Bool
     */
    private $errorStatement = false;

    private $response;

    /**
     * @var array
     */
    private $errorMessages = array();

    /**
     * @var ConstraintViolationList
     */
    private $constraintsViolationlist;

    /**
     * @var int
     */
    private $nullableId;

    /**
     * ServiceResponse constructor.
     * @param $response
     * @param ConstraintViolationList|null $constraintsViolationlist
     * @param bool $checkId
     */
    public function __construct($response, ?ConstraintViolationList $constraintsViolationlist = null, ?int $nullableId = null)
    {
        $this->response = $response;
        $this->constraintsViolationlist = $constraintsViolationlist;
        $this->nullableId = $nullableId;

        $this->checkBasicError();


    }

    private function checkBasicError(): void
    {
        if (!is_null($this->nullableId)) {
            $this->errorMessages->add(self::NO_ID_MESSAGE);
        }

        if (!is_null($this->constraintsViolationlist)) {
            foreach ($this->constraintsViolationlist as $item) {
                $this->errorMessages->add($item->getPropertyPath() . ' ' . $item->getMessage());
            }
        }

        if (empty($this->response)) {
            $this->errorMessages->add(self::NO_RESPONSE_MESSAGE);
        }
        if (!empty($this->errorMessages)) {
            $this->errorStatement = true;
        }
    }

    public function addCustomError(Sting $message)
    {
        $this->errorStatement = true;
        $this->addMessageError($message);
    }

    /**
     * @return bool
     */
    public function isErrorStatement(): bool
    {
        return $this->errorStatement;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }
}