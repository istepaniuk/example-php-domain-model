<?php

namespace Newsletter\Domain;

use Newsletter\Domain\Subscriber\Subscriber;

interface NewsletterSender
{
    public function sendNewsletter(
        Newsletter $newsletter,
        Subscriber $subscriber
    );
}
