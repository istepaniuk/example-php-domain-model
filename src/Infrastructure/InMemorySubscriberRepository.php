<?php

declare(strict_types=1);

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Domain\Subscriber\SubscriberRepository;

final class InMemorySubscriberRepository implements SubscriberRepository
{
    private array $subscribers = [];

    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber
    {
        $key = (string) $emailAddress;
        if (!isset($this->subscribers[$key])) {
            throw new SubscriberNotFoundException();
        }

        return $this->subscribers[$key];
    }

    public function save(Subscriber $subscriber): void
    {
        $key = (string) $subscriber->email();
        $state = unserialize(serialize($subscriber));
        $this->subscribers[$key] = $state;
    }

    public function all(): array
    {
        return $this->subscribers;
    }
}
