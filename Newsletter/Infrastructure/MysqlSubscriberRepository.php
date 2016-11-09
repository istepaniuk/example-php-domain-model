<?php

use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberRepository;

class MysqlSubscriberRepository implements SubscriberRepository
{
    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    public function get($emailAddress)
    {
        /*
        $pkey = strval($emailAddress);
        //SELECT * FROM `subscriber` WHERE ... = $pkey;
        if () ... throw EmailAddressNotFoundException();

        return new Subscriber(..., ...);
        */
    }

    public function save(Subscriber subscriber)
    {
        /*
        // UPSERT by key
        */
    }
}