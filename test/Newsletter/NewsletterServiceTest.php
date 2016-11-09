<?php

use Newsletter\Domain\NewsletterService;

class NewsletterServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function doesNotSendNewslettersIfThereAreNoSubscribers()
    {
        $sender = $this->createMock(NewsletterService::class);
        $clock = $this->createMock(NewsletterService::class);
        $sender = $this->createMock(NewsletterService::class);
        $service = new NewsletterService($repository, $clock, $sender);
    }
}
