<?php

namespace Newsletter\Domain;

interface SubscriberRepository
{
    public function get($emailAddress);

    public function save(Subscriber $subscriber);
}

