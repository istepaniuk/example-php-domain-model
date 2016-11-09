<?php

namespace Newsletter\Domain;

use Ramsey\Uuid\Uuid;

class SubscriberId
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function generate(){
        $uuid = Uuid::uuid4();
        return new SubscriberId($uuid);
    }

    public function getValue()
    {
        return $this->value;
    }

}