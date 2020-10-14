<?php

declare(strict_types=1);

namespace Newsletter\Tests\Application;

use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber\Subscriber;

final class FakeSenderThatRecordsSentEmails implements NewsletterSender
{
    public array $sentEmails = [];

    public function send(Newsletter $newsletter, Subscriber $subscriber): void
    {
        $this->sentEmails[] = (string) $subscriber->email();
    }
}
