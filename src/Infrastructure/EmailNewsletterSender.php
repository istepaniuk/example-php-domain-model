<?php

declare(strict_types=1);

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber\Subscriber;

final class EmailNewsletterSender implements NewsletterSender
{
    public function send(Newsletter $newsletter, Subscriber $subscriber): void
    {
        $success = mail(
            (string) $subscriber->email(),
            (string) $newsletter->subject(),
            (string) $newsletter->body()
        );

        if (!$success) {
            throw new \Exception('Error sending email');
        }
    }
}
