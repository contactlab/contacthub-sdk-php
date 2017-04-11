<?php
namespace ContactHub;

use Exception as BaseException;

class Exception extends BaseException
{
    private $logRef;
    private $data;
    private $errors;

    public function __construct($json)
    {
        parent::__construct($json['message']);
        $this->logRef = $json['logref'];
        $this->data = $json['data'];
        $this->errors = $json['errors'];
    }

    /**
     * @return mixed
     */
    public function getLogRef()
    {
        return $this->logRef;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}