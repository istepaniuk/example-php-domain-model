<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\EmailAddress;
use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberNotFoundException;
use Newsletter\Domain\SubscriberRepository;

class MysqlSubscriberRepository implements SubscriberRepository
{
    private $connectionString;

    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    public function getByEmailAddress(EmailAddress $emailAddress)
    {
        throw new SubscriberNotFoundException();
        /*
        $id = strval($emailAddress);
        //SELECT * FROM subscriber WHERE id = $id;
        if (empty...) ... throw EmailAddressNotFoundException();

        return new Subscriber(..., ...);
        */
    }

    public function save(Subscriber $subscriber)
    {
        // UPSERT by key
    }

    public function getAll()
    {
        // SELECT * FROM subscribers;
        // return new Subscriber() array
    }
}