<?php

declare(strict_types=1);

namespace Newsletter\Website;

use Newsletter\Application\NewsletterService;
use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\SubscriberName;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Infrastructure\EmailNewsletterSender;
use Newsletter\Infrastructure\MysqlSubscriberRepository;
use Newsletter\Infrastructure\SystemClock;

final class NewsletterController
{
    private NewsletterService $service;

    public function __construct()
    {
        // This could be injected using a Factory or a DI Framework, etc.

        $this->service = new NewsletterService(
            new MySqlSubscriberRepository('mysql://localhost/newsletter'),
            new SystemClock(),
            new EmailNewsletterSender()
        );
    }

    public function optOutAction($emailAddress): string
    {
        try {
            $emailAddress = EmailAddress::fromString($emailAddress);
        } catch (\InvalidArgumentException $e) {
            return $this->render(400, 'Error400.html.twig');
        }

        try {
            $this->service->optOut($emailAddress);

            return $this->render(200, 'Newsletter:opt_out_thanks.html.twig');
        } catch (SubscriberNotFoundException $e) {
            return $this->render(404, 'Newsletter:error.html.twig');
        }
    }

    public function signUp($firstName, $lastName, $emailAddress)
    {
        try {
            $emailAddress = EmailAddress::fromString($emailAddress);
            $name = SubscriberName::fromStrings($firstName, $lastName);
        } catch (\InvalidArgumentException $e) {
            return $this->render(400, 'Error400.html.twig');
        }

        $this->service->signUp($emailAddress, $name);

        return $this->render(200, 'Newsletter:opt_out_thanks.html.twig');
    }

    public function listAllSubscribers()
    {
        $subscribers = $this->service->subscribers();

        return $this->render(200, 'Newsletter:subscriber_list.html.twig', $subscribers);
    }

    private function render(int $errorCode, string $template, $context = []): string
    {
        // renders a fancy template
        return 'something';
    }
}
