<?php

namespace Test\Newsletter;

use Newsletter\Application\NewsletterService;
use Newsletter\Domain\Clock;
use Newsletter\Domain\EmailAddress;
use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberId;
use Newsletter\Domain\SubscriberName;
use Newsletter\Domain\SubscriberRepository;
use PHPUnit\Framework\TestCase;


class NewsletterServiceTest extends TestCase
{
    /**
     * @var SubscriberRepository
     */
    private $repository;
    private $sender;

    /**
     * @var NewsletterService
     */
    private $service;
    private $sentEmails = [];


    public function setUp()
    {
        $clock = $this->createMock(Clock::class);
        $clock->method('utcNow')->willReturn(new \DateTime());
        $this->sender = $this->createFakeSenderThatRecordsSentEmails();
        $this->repository = new InMemorySubscriberRepository();

        $this->service = new NewsletterService(
            $this->repository,
            $clock,
            $this->sender);
    }

    /**
     * @test
     */
    public function doesNotSendNewslettersIfThereAreNoSubscribers()
    {
        $newsletter = new Newsletter("A Test", "Testing...");
        self::assertEmpty($this->repository->getAll());

        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertEmpty($this->sentEmails);
    }

    /**
     * @test
     */
    public function sendsNewsletterToASubscriber()
    {
        $email = new EmailAddress("jdoe@example.com");
        $name = new SubscriberName("John", "Doe");
        $this->service->signUp($email, $name);

        $newsletter = new Newsletter("A Test", "Testing...");
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertContains(strval($email), $this->sentEmails);
    }

    /**
     * @test
     */
    public function doesNotSendNewslettersToASubscriberThatOptedOut()
    {
        $email = new EmailAddress("jdoe@example.com");
        $name = new SubscriberName("John", "Doe");
        $this->service->signUp($email, $name);

        $this->service->optOutSubscriber($email);
        $newsletter = new Newsletter("A Test", "Testing...");
        $this->service->sendNewsletterToAllSubscribers($newsletter);

        self::assertNotContains(strval($email), $this->sentEmails);
    }


    private function createFakeSenderThatRecordsSentEmails()
    {
        $mock = $this->createMock(NewsletterSender::class);
        $mock->method('sendNewsletter')
            ->with($this->anything(), $this->callback(
                function (Subscriber $to) {
                    array_push($this->sentEmails, strval($to->getEmail()));
                    return true;
                }));

        return $mock;
    }
}
