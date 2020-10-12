<?php

namespace Newsletter\Website;

use Newsletter\Application\NewsletterService;
use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\SubscriberName;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Infrastructure\MysqlSubscriberRepository;
use Newsletter\Infrastructure\SendgridNewsletterSender;
use Newsletter\Infrastructure\SystemClock;

final class NewsletterController
{
    private $newsletterService;

    public function __construct()
    {
        // This could be solved using a Factory or a DI Framework
        $this->newsletterService = new NewsletterService(
            new MySqlSubscriberRepository('mysql://localhost/newsletter'),
            new SystemClock(),
            new SendgridNewsletterSender()
        );
    }

    public function optOutAction($emailAddress)
    {
        try {
            $emailAddress = EmailAddress::fromString($emailAddress);
        } catch (\InvalidArgumentException $e) {
            return $this->render('Error400.html.twig');
        }

        try {
            $this->newsletterService->optOutSubscriber($emailAddress);

            return $this->render('Newsletter:opt_out_thanks.html.twig');
        } catch (SubscriberNotFoundException $e) {
            return $this->render('Newsletter:error.html.twig');
        }
    }

    public function signUp($firstName, $lastName, $emailAddress)
    {
        try {
            $emailAddress = EmailAddress::fromString($emailAddress);
            $name = SubscriberName::fromStrings($firstName, $lastName);
        } catch (\InvalidArgumentException $e) {
            return $this->render('Error400.html.twig');
        }

        $this->newsletterService->signUp($emailAddress, $name);

        return $this->render('Newsletter:opt_out_thanks.html.twig');
    }

    private function render($template)
    {
        return 'something';
    }
}
