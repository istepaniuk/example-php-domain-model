<?php

namespace Newsletter\Application;

use Newsletter\Domain\Clock;
use Newsletter\Domain\Newsletter;
use Newsletter\Domain\NewsletterSender;
use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberId;
use Newsletter\Domain\Subscriber\SubscriberName;
use Newsletter\Domain\Subscriber\SubscriberRepository;

final class NewsletterService
{
    private $subscriberRepository;
    private $clock;
    private $sender;

    public function __construct(
        SubscriberRepository $subscriberRepository,
        Clock $clock,
        NewsletterSender $sender
    ) {
        $this->subscriberRepository = $subscriberRepository;
        $this->clock = $clock;
        $this->sender = $sender;
    }

    public function signUp(EmailAddress $emailAddress, SubscriberName $name)
    {
        $id = SubscriberId::generate();
        $subscriber = Subscriber::create($id, $emailAddress, $name);
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
        $subscribers = $this->subscriberRepository->all();
        foreach ($subscribers as $subscriber) {
            if ($subscriber->isSubscribed()) {
                $this->sender->send($newsletter, $subscriber);
            }
        }
    }
}
