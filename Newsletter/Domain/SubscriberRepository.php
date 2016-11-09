<?php

namespace Newsletter\Domain;

interface SubscriberRepository
{
    public function getByEmailAddress($emailAddress);

    public function save(Subscriber $subscriber);
}

