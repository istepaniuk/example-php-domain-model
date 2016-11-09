<?php

namespace Newsletter\Domain;

class NewsletterService
{
    private $subscriberRepository;

    public function __construct(
        SubscriberRepository $subscriberRepository,
        Clock $clock)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function optOutSubscriber(EmailAddress $emailAddress)
    {
        $subscriber = $this->subscriberRepository->get($emailAddress);
        $now = $this->clock->utcNow();
        $subscriber->optOut($now);
        $this->subscriberRepository->save($subscriber);
    }


    public function signUp(EmailAddress $emailAddress, SubscriberName $name)
    {
        $id = SubscriberId::generate();
        $subscriber = new Subscriber($id, $emailAddress, $name);
        $this->subscriberRepository->save($subscriber);
    }
}