<?php

namespace Newsletter\Domain\Subscriber;

final class SubscriberName
{
    private $firstName;
    private $lastName;

    public function __construct($firstName, $lastName)
    {
        if (!$firstName || !$lastName) {
            throw new \InvalidArgumentException('Both first and last name are mandatory');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }
}
