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
        /*

        SELECT * FROM `subscriber` WHERE `email` = $email;

        if (empty...) {
          throw EmailAddressNotFoundException();
        }

        return new Subscriber(..., ...);

        */

        throw new SubscriberNotFoundException();
    }

    public function save(Subscriber $subscriber): void
    {
        /*

        INSERT INTO `subscriber` ...
        ON CONFLICT UPDATE ... ;

        */
    }

    public function all(): array
    {
        /*

        SELECT * FROM `subscriber`;

        foreach result -> new Subscriber()

        */

        return [];
    }
}
