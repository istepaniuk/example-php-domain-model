<?php

declare(strict_types=1);

namespace Newsletter\Domain\Subscriber;

final class SubscriberName
{
    private string $firstName;
    private string $lastName;

    private function __construct(string $firstName, string $lastName)
    {
        if (empty($firstName) || empty($lastName)) {
            throw new \InvalidArgumentException('Both first and last name are mandatory');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public static function fromStrings(string $firstName, string $lastName): self
    {
        return new self($firstName, $lastName);
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function equals(self $other): bool
    {
        return $this->firstName == $other->firstName
            && $this->lastName == $other->lastName;
    }

    public function __toString(): string
    {
        return "$this->firstName $this->lastName";
    }
}
