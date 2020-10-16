<?php

declare(strict_types=1);

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberId;
use Newsletter\Domain\Subscriber\SubscriberRepository;

final class MySqlSubscriberRepository implements SubscriberRepository
{
    private string $connectionString;

    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    public function save(Subscriber $subscriber): void
    {
        /*

        INSERT INTO `subscriber` ...
        ON CONFLICT UPDATE ... ;

        */

        throw new \BadMethodCallException('Not implemented');
    }

    public function get(SubscriberId $id): Subscriber
    {
        /*

        SELECT * FROM `subscriber` WHERE `id` = $id;

        if (empty...) {
          throw SubscriberNotFoundException();
        }

        return new Subscriber(..., ...);

        */

        throw new \BadMethodCallException('Not implemented');
    }

    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber
    {
        /*

        SELECT * FROM `subscriber` WHERE `email` = $email;

        if (empty...) {
          throw SubscriberNotFoundException();
        }

        return new Subscriber(..., ...);

        */

        throw new \BadMethodCallException('Not implemented');
    }

    public function all(): array
    {
        /*

        SELECT * FROM `subscriber`;

        foreach result -> new Subscriber()

        */

        throw new \BadMethodCallException('Not implemented');
    }
}
