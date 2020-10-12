<?php

namespace Newsletter\Domain\Subscriber;

final class SubscriberName
{
    private $firstName;
    private $lastName;

    private function __construct($firstName, $lastName)
    {
        if (!$firstName || !$lastName) {
            throw new \InvalidArgumentException('Both first and last name are mandatory');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public static function fromStrings(string $firstName, string $lastName): self
    {
        return new self($firstName, $lastName);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function toArray(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ];
    }
}
