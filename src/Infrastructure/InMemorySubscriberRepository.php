<?php

declare(strict_types=1);

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Subscriber\EmailAddress;
use Newsletter\Domain\Subscriber\Subscriber;
use Newsletter\Domain\Subscriber\SubscriberEmailAddressAlreadyInUse;
use Newsletter\Domain\Subscriber\SubscriberId;
use Newsletter\Domain\Subscriber\SubscriberNotFoundException;
use Newsletter\Domain\Subscriber\SubscriberRepository;

final class InMemorySubscriberRepository implements SubscriberRepository
{
    private array $subscribers = [];
    private array $subscriberIdsByEmail = [];

    public function save(Subscriber $subscriber): void
    {
        $id = (string) $subscriber->id();
        $email = (string) $subscriber->email();
        $this->throwIfEmailInUseByDifferentSubscriber($id, $email);
        $this->subscribers[$id] = unserialize(serialize($subscriber));
        $this->subscriberIdsByEmail[$email] = $id;
    }

    public function get(SubscriberId $id): Subscriber
    {
        $key = (string) $id;
        if (!isset($this->subscribers[$key])) {
            throw new SubscriberNotFoundException();
        }

        return $this->subscribers[$key];
    }

    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber
    {
        $key = (string) $emailAddress;
        if (!isset($this->subscriberIdsByEmail[$key])) {
            throw new SubscriberNotFoundException();
        }

        return $this->subscribers[$this->subscriberIdsByEmail[$key]];
    }

    public function all(): array
    {
        return $this->subscribers;
    }

    private function throwIfEmailInUseByDifferentSubscriber(string $id, string $email): void
    {
        if (($this->subscriberIdsByEmail[$email] ?? $id) != $id) {
            throw new SubscriberEmailAddressAlreadyInUse();
        }
    }
}
