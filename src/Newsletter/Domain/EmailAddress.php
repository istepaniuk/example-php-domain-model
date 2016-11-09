<?php

namespace Newsletter\Domain;

class EmailAddress
{
    private $address;

    public function __construct($address)
    {
        $this->validateAddress($address);
        $this->address = $address;
    }

    public function __toString()
    {
        return $this->address;
    }

    private function validateAddress($emailAddressString)
    {
        //if not valid, throw new \InvalidArgumentException();
    }
}