<?php

namespace ContactHub;

/**
 * Request object for create bring back properties
 * @package ContactHub
 */
class BringBackProperties
{
    const SESSION_ID = 'SESSION_ID';
    const EXTERNAL_ID = 'EXTERNAL_ID';

    private $type;
    private $value;

    /**
     * BringBackProperties constructor.
     * @param $type
     * @param $value
     */
    private function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @param $value
     * @return BringBackProperties
     */
    public static function fromSessionId($value)
    {
        return new self(self::SESSION_ID, $value);
    }

    /**
     * @param $value
     * @return BringBackProperties
     */
    public static function fromExternalId($value)
    {
        return new self(self::EXTERNAL_ID, $value);
    }

    /**
     * @return array
     */
    public function toParams()
    {
        return [
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}