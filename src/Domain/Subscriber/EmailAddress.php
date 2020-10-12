<?php

namespace Newsletter\Domain\Subscriber;

final class EmailAddress
{
    private $address;

    private function __construct($address)
    {
        $this->validateAddress($address);
        $this->address = $address;
    }

    public static function fromString($address): self
    {
        return new self($address);
    }

    public function equals(self $other): bool
    {
        return $this->address == $other->address;
    }

    private function validateAddress($emailAddressString): void
    {
        //if not valid, throw new \InvalidArgumentException();
    }

    public function __toString(): string
    {
        return $this->address;
    }
}
