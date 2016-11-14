<?php

namespace Newsletter\Application;

use Newsletter\Domain\Clock;
use Newsletter\Domain\EmailAddress;
use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberId;
use Newsletter\Domain\SubscriberName;
use Newsletter\Domain\SubscriberRepository;

class NewsletterService
{
    private $subscriberRepository;
    private $clock;
    private $sender;

    public function __construct(
        SubscriberRepository $subscriberRepository,
        Clock $clock,
        NewsletterSender $sender)
    {
        $this->subscriberRepository = $subscriberRepository;
        $this->clock = $clock;
        $this->sender = $sender;
    }

    public function signUp(EmailAddress $emailAddress, SubscriberName $name)
    {
        $id = SubscriberId::generate();
        $subscriber = new Subscriber($id, $emailAddress, $name);
        $this->subscriberRepository->save($subscriber);
    }

    public function optOutSubscriber(EmailAddress $emailAddress)
    {
        $subscriber = $this->subscriberRepository->getByEmailAddress($emailAddress);
        $now = $this->clock->utcNow();
        $subscriber->optOut($now);
        $this->subscriberRepository->save($subscriber);
    }

    public function sendNewsletterToAllSubscribers(Newsletter $newsletter)
    {
        $subscribers = $this->subscriberRepository->getAll();
        foreach ($subscribers as $subscriber) {
            if ($subscriber->isSubscribed()) {
                $this->sender->sendNewsletter($newsletter, $subscriber);
            }
        }
    }
}