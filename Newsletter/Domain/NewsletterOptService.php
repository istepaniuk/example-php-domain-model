<?php

namespace Newsletter\Domain;

class NewsletterOptService
{
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepository = subscriberRepository;
    }

    public function optOutSubscriber(EmailAddress $emailAddress)
    {
        $subscriber = $this->subscriberRepository->get($emailAddress);
        $now = $this->clock->utcNow();
        $subscriber->optOut($now);
        $this->subscriberRepository->save($subscriber);
    }
}