<?php

declare(strict_types=1);

namespace Newsletter\Tests\Infrastructure;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\SubscriberEmailAddressAlreadyInUse;
use Newsletter\Domain\Subscriber\SubscriberId;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Domain\Subscriber\SubscriberRepository;
use Newsletter\Tests\Fixtures;
use PHPUnit\Framework\TestCase;

abstract class AbstractSubscriberRepositoryTest extends TestCase
{
    protected SubscriberRepository $repository;

    public function test_it_can_store_a_subscriber_and_retrieve_it_by_id()
    {
        $subscriber = Fixtures::aGivenSubscriber();

        $this->repository->save($subscriber);
        $retrieved = $this->repository->get($subscriber->id());

        self::assertEquals($subscriber, $retrieved);
    }

    public function test_it_can_store_a_subscriber_and_retrieve_it_by_email_address()
    {
        $subscriber = Fixtures::aGivenSubscriber();

        $this->repository->save($subscriber);
        $retrieved = $this->repository->getByEmailAddress($subscriber->email());

        self::assertEquals($subscriber, $retrieved);
    }

    public function test_it_throws_an_error_when_a_subscriber_does_not_exist_by_email_id()
    {
        $idThatDoesNotExist = SubscriberId::generate();
        $this->expectException(SubscriberNotFoundException::class);

        $this->repository->get($idThatDoesNotExist);
    }

    public function test_it_throws_an_error_when_a_subscriber_does_not_exist_by_email_address()
    {
        $this->expectException(SubscriberNotFoundException::class);

        $this->repository->getByEmailAddress(EmailAddress::fromString('unknown@example.com'));
    }

    public function test_it_throws_an_error_when_saving_a_subscriber_with_an_email_address_already_in_use()
    {
        $this->repository->save(Fixtures::aGivenSubscriber());

        $this->expectException(SubscriberEmailAddressAlreadyInUse::class);

        $this->repository->save(Fixtures::aGivenSubscriber());
    }
}
