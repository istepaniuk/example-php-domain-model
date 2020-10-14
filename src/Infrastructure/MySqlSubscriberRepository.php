<?php

declare(strict_types=1);

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Domain\Subscriber\SubscriberRepository;

final class MySqlSubscriberRepository implements SubscriberRepository
{
    private string $connectionString;

    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber
    {
        throw new SubscriberNotFoundException();
        /*
        //SELECT * FROM subscriber WHERE email = $email;

        if (empty...) ... throw EmailAddressNotFoundException();

        return new Subscriber(..., ...);
        */
    }

    public function save(Subscriber $subscriber): void
    {
        // UPSERT
    }

    public function all(): array
    {
        // SELECT * FROM subscribers;
        // foreach result -> return new Subscriber()

        return [];
    }
}
