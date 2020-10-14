<?php

declare(strict_types=1);

namespace Newsletter\Tests\Infrastructure;

use Newsletter\Domain\Subscriber\SubscriberRepository;
use Newsletter\Tests\Fixtures;
use PHPUnit\Framework\TestCase;

abstract class AbstractSubscriberRepositoryTest extends TestCase
{
    protected SubscriberRepository $repository;

    public function test_it_can_store_and_retrieve_a_subscriber()
    {
        $subscriber = Fixtures::aGivenSubscriber();

        $this->repository->save($subscriber);
        $retrieved = $this->repository->getByEmailAddress($subscriber->email());

        self::assertEquals($subscriber, $retrieved);
    }
}
