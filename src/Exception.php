<?php
namespace ContactHub;

use Exception as BaseException;

class Exception extends BaseException
{
    private $logref;
    private $data;
    private $errors;

    public static function fromJson($json)
    {
        $data = json_decode($json, true);
        if (self::is404ErrorMessage($data)) {
            return new static($data['error']);
        }
        return new static($data['message'], $data['logref'], $data['data'], $data['errors']);
    }

    public function __construct($message, $logref = '', $data = '', $errors = [])
    {
        parent::__construct($message);
        $this->logref = $logref;
        $this->data = $data;
        $this->errors = $errors;
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

    /**
     * @param $data
     * @return bool
     */
    private static function is404ErrorMessage($data)
    {
        return (isset($data['status']) ? $data['status'] : null) == 404;
    }

}