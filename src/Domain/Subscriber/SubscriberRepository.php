<?php

declare(strict_types=1);

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
