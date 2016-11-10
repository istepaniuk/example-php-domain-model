<?php

namespace Test\Newsletter;

use Newsletter\Domain\EmailAddress;
use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberNotFoundException;
use Newsletter\Domain\SubscriberRepository;

class InMemorySubscriberRepository implements SubscriberRepository
{
    private $subscribers = [];

    public function getByEmailAddress(EmailAddress $emailAddress)
    {
        foreach ($this->subscribers as $subscriber){
            if ($subscriber->getEmailAddress->equals($emailAddress)){
                return $subscriber;
            }
        }
        throw new SubscriberNotFoundException();
    }

    public function save(Subscriber $subscriber)
    {
        $key = strval($subscriber->getId()->getValue());
        $this->subscribers[$key] = $subscriber;
    }

    public function getAll()
    {
        return array_values($this->subscribers);
    }
}