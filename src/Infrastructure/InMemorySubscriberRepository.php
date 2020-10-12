<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Domain\Subscriber\SubscriberRepository;

final class InMemorySubscriberRepository implements SubscriberRepository
{
    private $subscribers = [];

    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber
    {
        $key = (string) $emailAddress;
        if (!isset($this->subscribers[$key])) {
            throw new SubscriberNotFoundException();
        }
        $state = $this->subscribers[$key];

        return $this->reconstructSubscriberFromState($state);
    }

    public function save(Subscriber $subscriber): void
    {
        $key = (string) ($subscriber->email());
        $state = serialize($subscriber);
        $this->subscribers[$key] = $state;
    }

    public function all(): array
    {
        return array_map(
            __CLASS__.'::reconstructSubscriberFromState',
            $this->subscribers
        );
    }

    private static function reconstructSubscriberFromState($subscriberData)
    {
        return unserialize($subscriberData);
    }
}
