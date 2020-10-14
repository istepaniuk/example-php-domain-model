<?php

declare(strict_types=1);

namespace Newsletter\Domain\Subscriber;

use DateTimeInterface;

final class Subscriber
{
    private SubscriberId $id;
    private EmailAddress $email;
    private SubscriberName $name;
    private bool $isSubscribed;
    private ?DateTimeInterface $optedOutAt;

    private function __construct(SubscriberId $id, EmailAddress $email, SubscriberName $name)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->isSubscribed = true;
        $this->optedOutAt = null;
    }

    public static function create(SubscriberId $id, EmailAddress $email, SubscriberName $name): self
    {
        return new self($id, $email, $name);
    }

    public function id(): SubscriberId
    {
        return $this->id;
    }

    public function email(): EmailAddress
    {
        return $this->email;
    }

    public function name(): SubscriberName
    {
        return $this->name;
    }

    public function optOut(DateTimeInterface $optedOutAt): void
    {
        $this->isSubscribed = false;
        $this->optedOutAt = $optedOutAt;
    }

    public function isSubscribed(): bool
    {
        return $this->isSubscribed;
    }

    public function lastOptedOutAt(): DateTimeInterface
    {
        return $this->optedOutAt;
    }

    public function __toString(): string
    {
        return sprintf('%s <%s>', $this->name, $this->email);
    }
}
