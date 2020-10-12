<?php

namespace Newsletter\Domain;

use Newsletter\Domain\Subscriber\Subscriber;

interface NewsletterSender
{
    public function send(Newsletter $newsletter, Subscriber $subscriber): void;
}
