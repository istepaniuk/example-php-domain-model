<?php

declare(strict_types=1);

namespace Newsletter\Tests;

use Newsletter\Domain\Newsletter;
use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberId;
use Newsletter\Domain\Subscriber\SubscriberName;

final class Fixtures
{
    public static function aGivenSubscriber(): Subscriber
    {
        $id = SubscriberId::generate();
        $email = self::aGivenEmailAddress();
        $name = self::aGivenSubscriberName();

        return Subscriber::create($id, $email, $name);
    }

    public static function aGivenEmailAddress(): EmailAddress
    {
        return EmailAddress::fromString('john.doe@example.com');
    }

    public static function aGivenSubscriberName(): SubscriberName
    {
        return SubscriberName::fromStrings('John', 'Doe');
    }

    public static function aGivenNewsletter(): Newsletter
    {
        return Newsletter::fromStrings('A Test', 'Testing...');
    }
}
