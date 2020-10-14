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
    }

    public function test_it_is_equal_when_compared_to_an_identical_subscriber()
    {
        $id = SubscriberId::generate();
        $email = EmailAddress::fromString('jdoe@example.com');
        $name = SubscriberName::fromStrings('John', 'Doe');

        $subscriber1 = Subscriber::create($id, $email, $name);
        $subscriber2 = Subscriber::create($id, $email, $name);

        self::assertTrue($subscriber1->equals($subscriber2));
    }

    public function test_it_is_not_equal_when_compared_to_an_identical_subscriber()
    {
        $subscriber1 = Fixtures::aGivenSubscriber();
        $subscriber2 = Fixtures::aGivenSubscriber();

        self::assertFalse($subscriber1->equals($subscriber2));
    }
}
