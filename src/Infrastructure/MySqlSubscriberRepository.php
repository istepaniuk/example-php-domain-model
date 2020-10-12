<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Domain\Subscriber\SubscriberRepository;

final class MySqlSubscriberRepository implements SubscriberRepository
{
    private $connectionString;

    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber
    {
        throw new SubscriberNotFoundException();
        /*
        $id = strval($emailAddress);
        //SELECT * FROM subscriber WHERE id = $id;
        if (empty...) ... throw EmailAddressNotFoundException();

        return new Subscriber(..., ...);
        */
    }

    public function save(Subscriber $subscriber): void
    {
        // UPSERT by key
    }

    public function getAll(): array
    {
        // SELECT * FROM subscribers;
        // return new Subscriber() array
    }
}
