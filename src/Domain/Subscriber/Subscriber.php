<?php

namespace Newsletter\Domain\Subscriber;

final class Subscriber
{
    private $id;
    private $email;
    private $name;
    private $subscribed;
    private $optedOutAt;

    public function __construct(
        SubscriberId $id,
        EmailAddress $email,
        SubscriberName $name
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->subscribed = true;
        $this->optedOutAt = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function optOut(\DateTime $optedOutAt)
    {
        $this->subscribed = false;
        $this->optedOutAt = $optedOutAt;
    }

    public function isSubscribed()
    {
        return $this->subscribed;
    }

    public function lastOptedOutAt()
    {
        return $this->optedOutAt;
    }

    public function __toString()
    {
        return sprintf('%s <%s>', $this->name, $this->email);
    }
}
