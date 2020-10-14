<?php

declare(strict_types=1);

namespace Newsletter\Tests\Domain\Subscriber;

use Newsletter\Domain\Subscriber\SubscriberName;
use Newsletter\Tests\Fixtures;
use PHPUnit\Framework\TestCase;

final class SubscriberNameTest extends TestCase
{
    public function test_it_can_be_created_from_strings()
    {
        $name = SubscriberName::fromStrings(
            $stringFirstName = 'Jane',
            $stringLastName = 'Doe'
        );

        self::assertInstanceOf(SubscriberName::class, $name);
        self::assertEquals($stringFirstName, $name->firstName());
        self::assertEquals($stringLastName, $name->lastName());
    }

    public function test_it_is_equal_when_compared_to_an_identical_name()
    {
        $name1 = SubscriberName::fromStrings('Jane', 'Doe');
        $name2 = SubscriberName::fromStrings('Jane', 'Doe');

        self::assertTrue($name1->equals($name2));
    }

    public function test_it_is_not_equal_when_compared_to_a_different_name()
    {
        $name1 = SubscriberName::fromStrings('Jane', 'Doe');
        $name2 = SubscriberName::fromStrings('Roger', 'Smith');

        self::assertFalse($name1->equals($name2));
    }

    public function test_it_cannot_be_created_with_an_empty_first_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        SubscriberName::fromStrings('', 'Doe');
    }

    public function test_it_cannot_be_created_with_an_empty_last_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        SubscriberName::fromStrings('John', '');
    }

    public function test_it_can_be_represented_as_string()
    {
        $subscriber = Fixtures::aGivenSubscriberName();

        self::assertEquals('John Doe', (string) $subscriber);
    }
}
