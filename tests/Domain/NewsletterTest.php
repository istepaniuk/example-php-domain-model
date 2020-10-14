<?php

declare(strict_types=1);

namespace Newsletter\Tests\Domain;

use Newsletter\Domain\Newsletter;
use PHPUnit\Framework\TestCase;

final class NewsletterTest extends TestCase
{
    public function test_it_can_be_created_from_strings()
    {
        $newsletter = Newsletter::fromStrings(
            $subject = 'Some Unimportant Subject',
            $body = 'This is the body of the newsletter.'
        );

        self::assertInstanceOf(Newsletter::class, $newsletter);
        self::assertEquals($subject, $newsletter->subject());
        self::assertEquals($body, $newsletter->body());
    }

    public function test_it_cannot_be_created_with_an_empty_subject()
    {
        $this->expectException(\InvalidArgumentException::class);

        Newsletter::fromStrings('', 'Something in the body');
    }

    public function test_it_cannot_be_created_with_an_empty_body()
    {
        $this->expectException(\InvalidArgumentException::class);

        Newsletter::fromStrings('Some subject', '');
    }
}
