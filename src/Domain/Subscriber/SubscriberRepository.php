<?php

declare(strict_types=1);

namespace Newsletter\Domain\Subscriber;

interface SubscriberRepository
{
    public function save(Subscriber $subscriber): void;

    /**
     * @throws SubscriberNotFoundException
     */
    public function get(SubscriberId $id): Subscriber;

    /**
     * @throws SubscriberNotFoundException
     */
    public function getByEmailAddress(EmailAddress $emailAddress): Subscriber;

    /**
     * @return Subscriber[]
     */
    public function all(): array;
}
