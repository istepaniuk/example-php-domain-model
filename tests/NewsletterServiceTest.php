<?php

namespace Newsletter\Tests;

use Newsletter\Application\NewsletterService;
use Newsletter\Domain\Clock;
use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberName;
use Newsletter\Infrastructure\InMemorySubscriberRepository;
use PHPUnit\Framework\TestCase;

class NewsletterServiceTest extends TestCase
{
    private $repository;
    private $service;
    private $sentEmails = [];
    private $fakeNow;

    protected function setUp(): void
    {
        $this->fakeNow = new \DateTime('2014-06-23T15:00:03+02:00');
        $clock = $this->prophesize(Clock::class);
        $clock->utcNow()->willReturn($this->fakeNow);
        $this->repository = new InMemorySubscriberRepository();

        $this->service = new NewsletterService(
            $this->repository,
            $clock->reveal(),
            $this->createFakeSenderThatRecordsSentEmails()
        );
    }

    public function testDoesNotSendNewslettersIfThereAreNoSubscribers()
    {
        $newsletter = new Newsletter('A Test', 'Testing...');
        self::assertEmpty($this->repository->getAll());

        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertEmpty($this->sentEmails);
    }

    public function testSendsNewsletterToASubscriber()
    {
        $email = new EmailAddress('jdoe@example.com');
        $name = new SubscriberName('John', 'Doe');
        $this->service->signUp($email, $name);

        $newsletter = new Newsletter('A Test', 'Testing...');
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertContains((string) $email, $this->sentEmails);
    }

    public function testDoesNotSendNewslettersToASubscriberThatOptedOut()
    {
        $email = new EmailAddress('jdoe@example.com');
        $name = new SubscriberName('John', 'Doe');
        $this->service->signUp($email, $name);

        $this->service->optOutSubscriber($email);
        $newsletter = new Newsletter('A Test', 'Testing...');
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertNotContains((string) $email, $this->sentEmails);
    }

    public function testRecordsTheTimeOnWhichASubscriberLastOptedOut()
    {
        $email = new EmailAddress('jdoe@example.com');
        $name = new SubscriberName('John', 'Doe');
        $this->service->signUp($email, $name);

        $this->service->optOutSubscriber($email);
        $stored = $this->repository->getByEmailAddress($email);
        self::assertEquals($stored->lastOptedOutAt(), $this->fakeNow);
    }

    private function createFakeSenderThatRecordsSentEmails()
    {
        $mock = $this->createMock(NewsletterSender::class);
        $mock->method('sendNewsletter')
            ->with($this->anything(), $this->callback(
                function (Subscriber $to) {
                    array_push($this->sentEmails, (string) ($to->getEmail()));

                    return true;
                }
            ));

        return $mock;
    }
}
