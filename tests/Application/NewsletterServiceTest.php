<?php

declare(strict_types=1);

namespace Newsletter\Tests\Application;

use DateTimeImmutable;
use Newsletter\Application\NewsletterService;
use Newsletter\Domain\Newsletter;
use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\SubscriberName;
use Newsletter\Domain\Subscriber\SubscriberRepository;
use Newsletter\Infrastructure\InMemorySubscriberRepository;
use PHPUnit\Framework\TestCase;

final class NewsletterServiceTest extends TestCase
{
    private SubscriberRepository $repository;
    private NewsletterService $service;
    private FakeSenderThatRecordsSentEmails $sender;
    private FakeClock $clock;

    protected function setUp(): void
    {
        $this->service = new NewsletterService(
            $this->repository = new InMemorySubscriberRepository(),
            $this->clock = new FakeClock(new DateTimeImmutable('2020-03-30 02:05:00')),
            $this->sender = new FakeSenderThatRecordsSentEmails()
        );
    }

    public function test_does_not_send_news_letters_if_there_are_no_subscribers()
    {
        $newsletter = Newsletter::fromStrings('A Test', 'Testing...');
        self::assertEmpty($this->repository->all());

        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertEmpty($this->sender->sentEmails);
    }

    public function test_sends_news_letter_to_a_subscriber()
    {
        $email = EmailAddress::fromString('jdoe@example.com');
        $name = SubscriberName::fromStrings('John', 'Doe');
        $this->service->signUp($email, $name);

        $newsletter = Newsletter::fromStrings('A Test', 'Testing...');
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertContains((string) $email, $this->sender->sentEmails);
    }

    public function test_does_not_send_news_letters_to_a_subscriber_that_opted_out()
    {
        $email = EmailAddress::fromString('jdoe@example.com');
        $name = SubscriberName::fromStrings('John', 'Doe');
        $this->service->signUp($email, $name);

        $this->service->optOutSubscriber($email);
        $newsletter = Newsletter::fromStrings('A Test', 'Testing...');
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertNotContains((string) $email, $this->sender->sentEmails);
    }

    public function test_records_the_time_on_which_a_subscriber_last_opted_out()
    {
        $email = EmailAddress::fromString('jdoe@example.com');
        $name = SubscriberName::fromStrings('John', 'Doe');
        $this->service->signUp($email, $name);

        $this->service->optOutSubscriber($email);
        $stored = $this->repository->getByEmailAddress($email);
        self::assertEquals($stored->lastOptedOutAt(), $this->clock->utcNow());
    }
}
