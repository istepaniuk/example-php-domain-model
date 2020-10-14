<?php

declare(strict_types=1);

namespace Newsletter\Tests\Domain\Subscriber;

use Newsletter\Domain\Subscriber\EmailAddress;
use PHPUnit\Framework\TestCase;

final class EmailAddressTest extends TestCase
{
    public function test_it_can_be_created_from_a_string()
    {
        $email = EmailAddress::fromString('some@example.com');

        self::assertInstanceOf(EmailAddress::class, $email);
    }

    public function test_it_can_be_represented_as_a_string()
    {
        $email = EmailAddress::fromString($stringEmail = 'some@example.com');

        self::assertEquals($stringEmail, (string) $email);
    }

    public function test_it_is_equal_when_compared_to_an_identical_address()
    {
        $email1 = EmailAddress::fromString('jane@example.com');
        $email2 = EmailAddress::fromString('jane@example.com');

        self::assertTrue($email1->equals($email2));
    }

    public function test_it_is_not_equal_when_compared_to_a_different_address()
    {
        $email1 = EmailAddress::fromString('jane@example.com');
        $email2 = EmailAddress::fromString('roger@example.com');

        self::assertFalse($email1->equals($email2));
    }

    public function test_it_cannot_be_created_with_an_empty_string()
    {
        $this->expectException(\InvalidArgumentException::class);

        EmailAddress::fromString('');
    }

    public function test_it_cannot_be_created_with_an_invalid_address()
    {
        $this->expectException(\InvalidArgumentException::class);

        EmailAddress::fromString('not_an_email');
    }
}
