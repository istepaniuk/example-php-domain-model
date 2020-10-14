<?php

declare(strict_types=1);

namespace Newsletter\Tests\Domain\Subscriber;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberId;
use Newsletter\Domain\Subscriber\SubscriberName;
use Newsletter\Tests\Fixtures;
use PHPUnit\Framework\TestCase;

final class SubscriberTest extends TestCase
{
    public function test_it_can_be_created_from_an_email_and_name()
    {
        $id = SubscriberId::generate();
        $email = EmailAddress::fromString('jdoe@example.com');
        $name = SubscriberName::fromStrings('John', 'Doe');

        $subscriber = Subscriber::create($id, $email, $name);

        self::assertTrue($subscriber->id()->equals($id));
        self::assertTrue($subscriber->email()->equals($email));
        self::assertTrue($subscriber->name()->equals($name));
        self::assertTrue($subscriber->isSubscribed());
    }

    public function test_it_can_be_represented_as_string()
    {
        $subscriber = Fixtures::aGivenSubscriber();

        self::assertEquals('John Doe <john.doe@example.com>', (string) $subscriber);
    }
}
