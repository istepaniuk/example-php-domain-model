<?php

namespace Newsletter\Domain\Subscriber;

use Rhumsaa\Uuid\Uuid;

final class SubscriberId
{
    private $value;

    protected function __construct($value)
    {
        $this->value = $value;
    }

    public static function fromString(string $value)
    {
        return new self($value);
    }

    public static function generate()
    {
        $uuid = Uuid::uuid4();

        return new self($uuid);
    }

    public function __toString()
    {
        return $this->value;
    }
}