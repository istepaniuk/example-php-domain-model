<?php

declare(strict_types=1);

namespace Newsletter\Domain\Subscriber;

final class EmailAddress
{
    private string $address;

    private function __construct(string $address)
    {
        $this->validateAddress($address);
        $this->address = $address;
    }

    public static function fromString(string $address): self
    {
        return new self($address);
    }

    public function equals(self $other): bool
    {
        return $this->address == $other->address;
    }

    private function validateAddress(string $address): void
    {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }
    }

    public function __toString(): string
    {
        return $this->address;
    }
}
