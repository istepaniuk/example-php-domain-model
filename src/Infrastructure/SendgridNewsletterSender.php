<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber\Subscriber;

final class SendgridNewsletterSender implements NewsletterSender
{
    public function sendNewsletter(Newsletter $newsletter, Subscriber $subscriber)
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
