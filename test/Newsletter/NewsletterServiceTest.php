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
use PHPUnit\Framework\TestCase;


class NewsletterServiceTest extends TestCase
{
    /**
     * @test
     */
    public function doesNotSendNewslettersIfThereAreNoSubscribers()
    {
        $clock = $this->createMock(Clock::class);
        $sender = $this->createMock(NewsletterSender::class);
        $repository = new InMemorySubscriberRepository();
        $service = new NewsletterService($repository, $clock, $sender);
        $newsletter = new Newsletter("A Test", "Testing...");

        $service->sendNewsletterToAllSubscribers($newsletter);

        self::assertEmpty($repository->getAll());
    }

    /**
     * @test
     */
    public function sendsNewsletterToASubscriber()
    {
        $clock = $this->createMock(Clock::class);
        $sender = $this->createMock(NewsletterSender::class);
        $repository = new InMemorySubscriberRepository();
        $service = new NewsletterService($repository, $clock, $sender);
        $newsletter = new Newsletter("A Test", "Testing...");

        $email = new EmailAddress("jdoe@example.com");
        $name = new SubscriberName("John", "Doe");
        $service->signUp($email, $name);


        $sentEmails = [];
        $sender->expects($this->once())
            ->method('sendNewsletter')
            ->with(
                $this->anything(),
                $this->callback(function (Subscriber $to) use ($sentEmails) {
                    $sentEmails = array_push($sentEmails, strval($to->getEmail()));
                    var_dump($sentEmails);
                    return true;
                }));

        $service->sendNewsletterToAllSubscribers($newsletter);

        var_dump($sentEmails);
        self::assertContains(strval($email), $sentEmails);
    }
}
