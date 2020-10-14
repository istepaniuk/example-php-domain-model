<?php

declare(strict_types=1);

namespace Newsletter\Tests\Application;

use Newsletter\Application\NewsletterService;
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
        $email = Fixtures::aGivenEmailAddress();
        $name = Fixtures::aGivenSubscriberName();
        $this->service->signUp($email, $name);

        $newsletter = Fixtures::aGivenNewsletter();
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertContains((string) $email, $this->sender->sentEmails);
    }

    public function test_it_does_not_send_newsletters_to_a_subscriber_that_opted_out()
    {
        $email = Fixtures::aGivenEmailAddress();
        $name = Fixtures::aGivenSubscriberName();
        $this->service->signUp($email, $name);
        $this->service->optOut($email);

        $this->service->sendNewsletterToAllSubscribers(Fixtures::aGivenNewsletter());

        self::assertEmpty($this->sender->sentEmails);
    }

    public function test_it_records_the_time_on_which_a_subscriber_opted_out()
    {
        $email = Fixtures::aGivenEmailAddress();
        $name = Fixtures::aGivenSubscriberName();
        $this->service->signUp($email, $name);

        $this->service->optOut($email);

        $subscriber = $this->repository->getByEmailAddress($email);
        self::assertEquals($subscriber->lastOptedOutAt(), $this->clock->utcNow());
    }
}
