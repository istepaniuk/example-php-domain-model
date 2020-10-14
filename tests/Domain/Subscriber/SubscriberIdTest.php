<?php

declare(strict_types=1);

namespace Newsletter\Tests\Domain\Subscriber;

use Newsletter\Domain\Subscriber\SubscriberId;
use PHPUnit\Framework\TestCase;

final class SubscriberIdTest extends TestCase
{
    public function test_it_can_be_created_from_a_string()
    {
        $id = SubscriberId::fromString($stringId = 'some-string');

        self::assertInstanceOf(SubscriberId::class, $id);
        self::assertEquals($stringId, (string) $id);
    }

    public function test_it_is_equal_when_compared_to_an_identical_id()
    {
        $id1 = SubscriberId::fromString('the-same-id');
        $id2 = SubscriberId::fromString('the-same-id');

        self::assertTrue($id1->equals($id2));
    }

    public function test_it_is_not_equal_when_compared_to_an_identical_id()
    {
        $id1 = SubscriberId::fromString('an-id');
        $id2 = SubscriberId::fromString('a-different-id');

        self::assertFalse($id1->equals($id2));
    }

    public function test_it_can_be_generated_uniquely_every_time()
    {
        $id1 = SubscriberId::generate();
        $id2 = SubscriberId::generate();
        $id3 = SubscriberId::generate();
        $id4 = SubscriberId::generate();

        self::assertFalse($id1->equals($id4));
        self::assertFalse($id2->equals($id3));
        self::assertFalse($id3->equals($id2));
        self::assertFalse($id4->equals($id1));
    }
}
