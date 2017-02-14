<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\EmailAddress;
use Newsletter\Domain\Subscriber;
use Newsletter\Domain\SubscriberNotFoundException;
use Newsletter\Domain\SubscriberRepository;

class InMemorySubscriberRepository implements SubscriberRepository
{
    private $subscribers = [];

    public function getByEmailAddress(EmailAddress $emailAddress)
    {
        $key = strval($emailAddress);
        if(!isset($this->subscribers[$key])) {
            throw new SubscriberNotFoundException();
        }
        $state = $this->subscribers[$key];

        return $this->reconstructSubscriberFromState($state);
    }

    public function save(Subscriber $subscriber)
    {
        $key = strval($subscriber->getEmail());
        $state = serialize($subscriber);
        $this->subscribers[$key] = $state;
    }

    public function getAll()
    {
        return array_map(
            __CLASS__ . '::reconstructSubscriberFromState',
            $this->subscribers);
    }

    private static function reconstructSubscriberFromState($subscriberData)
    {
        return unserialize($subscriberData);
    }
}