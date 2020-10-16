<?php

declare(strict_types=1);

namespace Newsletter\Tests\Application;

use Newsletter\Application\NewsletterService;
use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\SubscriberEmailAddressAlreadyInUse;
use Newsletter\Domain\Subscriber\SubscriberRepository;
use Newsletter\Infrastructure\InMemorySubscriberRepository;
use Newsletter\Tests\Fixtures;
use PHPUnit\Framework\TestCase;

final class NewsletterServiceTest extends TestCase
{
    private SubscriberRepository $repository;
    private NewsletterService $service;
    private FakeSenderThatRecordsSentEmails $sender;
    private FakeFrozenClock $clock;

    protected function setUp(): void
    {
        $this->service = new NewsletterService(
            $this->repository = new InMemorySubscriberRepository(),
            $this->clock = new FakeFrozenClock(),
            $this->sender = new FakeSenderThatRecordsSentEmails()
        );
    }

    public function test_it_does_not_send_newsletters_if_there_are_no_subscribers()
    {
        self::assertEmpty($this->repository->all());

        $this->service->sendNewsletterToAllSubscribers(Fixtures::aGivenNewsletter());

        self::assertEmpty($this->sender->sentEmails);
    }

    public function test_it_sends_a_newsletter_to_a_subscriber()
    {
        $this->givenASubscriberThatSignedUp($email = Fixtures::aGivenEmailAddress());

        $newsletter = Fixtures::aGivenNewsletter();
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertContains((string) $email, $this->sender->sentEmails);
    }

    public function test_it_does_not_send_newsletters_to_a_subscriber_that_opted_out()
    {
        $this->givenASubscriberThatSignedUp($email = Fixtures::aGivenEmailAddress());
        $this->service->optOut($email);

        $this->service->sendNewsletterToAllSubscribers(Fixtures::aGivenNewsletter());

        self::assertEmpty($this->sender->sentEmails);
    }

    public function test_it_records_the_time_on_which_a_subscriber_opted_out()
    {
        $this->givenASubscriberThatSignedUp($email = Fixtures::aGivenEmailAddress());

        $this->service->optOut($email);

        $subscriber = $this->repository->getByEmailAddress($email);
        self::assertEquals($subscriber->lastOptedOutAt(), $this->clock->utcNow());
    }

    public function test_it_provides_a_list_of_subscribers()
    {
        $this->givenASubscriberThatSignedUp(Fixtures::aGivenEmailAddress());
        $this->givenASubscriberThatSignedUp(Fixtures::someOtherEmailAddress());

        $subscribers = $this->service->subscribers();

        self::assertCount(2, $subscribers);
    }

    public function test_it_does_not_allow_to_signup_with_an_email_address_already_in_use()
    {
        $this->givenASubscriberThatSignedUp(Fixtures::aGivenEmailAddress());

        $this->expectException(SubscriberEmailAddressAlreadyInUse::class);

        $this->givenASubscriberThatSignedUp(Fixtures::aGivenEmailAddress());
    }

    private function givenASubscriberThatSignedUp(EmailAddress $withEmail): void
    {
        $name = Fixtures::aGivenSubscriberName();
        $this->service->signUp($withEmail, $name);
    }
}
