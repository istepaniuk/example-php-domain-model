<?php

namespace Newsletter\Domain\Subscriber;

use Rhumsaa\Uuid\Uuid;

final class SubscriberId
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function generate()
    {
        $uuid = Uuid::uuid4();

        return new self($uuid);
    }

    public function getValue()
    {
        return $this->value;
    }
}
