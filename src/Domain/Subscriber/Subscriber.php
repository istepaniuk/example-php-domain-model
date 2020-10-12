<?php

namespace Newsletter\Domain\Subscriber;

use DateTimeInterface;

final class Subscriber
{
    private $id;
    private $email;
    private $name;
    private $subscribed;
    private $optedOutAt;

    private function __construct(
        SubscriberId $id,
        EmailAddress $email,
        SubscriberName $name
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->subscribed = true;
        $this->optedOutAt = null;
    }

    public static function create(
        SubscriberId $id,
        EmailAddress $email,
        SubscriberName $name
    ) {
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

    public function optOut(\DateTime $optedOutAt): void
    {
        $this->subscribed = false;
        $this->optedOutAt = $optedOutAt;
    }

    public function isSubscribed(): bool
    {
        return $this->subscribed;
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
