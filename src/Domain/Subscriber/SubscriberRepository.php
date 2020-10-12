<?php

namespace Newsletter\Domain\Subscriber;

interface SubscriberRepository
{
    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber;

    public function save(Subscriber $subscriber): void;

    /**
     * @return Subscriber[]
     */
    public function all(): array;
}
