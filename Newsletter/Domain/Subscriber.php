<?php

namespace Newsletter\Domain;

class Subscriber
{
    private $id;

    public function __construct(SubscriberId $id,
                                EmailAddress $email,
                                SubsciberName $name)
    {
        $this->id = $id;
    }

}