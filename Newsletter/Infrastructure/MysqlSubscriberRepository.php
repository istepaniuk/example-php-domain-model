<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberRepository;

class MysqlSubscriberRepository implements SubscriberRepository
{
    private $connectionString;

    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    public function getByEmailAddress($emailAddress)
    {
        throw new SubscriberNotFoundException();
        /*
        $pkey = strval($emailAddress);
        //SELECT * FROM `subscriber` WHERE ... = $pkey;
        if () ... throw EmailAddressNotFoundException();

        return new Subscriber(..., ...);
        */
    }

    public function save(Subscriber $subscriber)
    {
        /*
        // UPSERT by key
        */
    }

    public function getAll()
    {
        // SELECT * FROM... return new Subscriber() array.
    }
}