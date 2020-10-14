<?php

declare(strict_types=1);

namespace Newsletter\Tests;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberId;
use Newsletter\Domain\Subscriber\SubscriberName;

final class Fixtures
{
    public static function aGivenSubscriber(): Subscriber
    {
        $id = SubscriberId::generate();
        $email = EmailAddress::fromString('jdoe@example.com');
        $name = SubscriberName::fromStrings('John', 'Doe');

        return Subscriber::create($id, $email, $name);
    }
}
