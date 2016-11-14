<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Newsletter;
use Newsletter\Domain\Subscriber;

class EmailNewsletterSender implements NewsletterSender
{

    public function sendNewsletter(Newsletter $newsletter,
                                   Subscriber $subscriber)
    {
        $success = mail(
            $subscriber->getEmail(),
            $newsletter->getSubject(),
            $newsletter->getMessage());

        if (!$success) {
            throw new Exception("Error sending email");
        }
    }
}