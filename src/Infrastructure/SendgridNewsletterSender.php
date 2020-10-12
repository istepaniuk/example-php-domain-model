<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber\Subscriber;

final class SendgridNewsletterSender implements NewsletterSender
{
    public function send(Newsletter $newsletter, Subscriber $subscriber): void
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
