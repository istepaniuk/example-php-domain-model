<?php

use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberRepository;

class MysqlSubscriberRepository implements SubscriberRepository
{
    private $connectionString;

    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    public function get($emailAddress)
    {
        throw new EmailAddressNotFoundException();
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