<?php

use Newsletter\Domain\Clock;
use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\NewsletterService;
use Newsletter\Domain\SubscriberRepository;

class NewsletterServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function doesNotSendNewslettersIfThereAreNoSubscribers()
    {
        $repository = $this->createMock(SubscriberRepository::class);
        $clock = $this->createMock(Clock::class);
        $sender = $this->createMock(NewsletterSender::class);

        $service = new NewsletterService($repository, $clock, $sender);

        $newsletter = new Newsletter("A test", "Testing...");
        $service->sendNewsletterToAllSubscribers($newsletter);
    }
}
