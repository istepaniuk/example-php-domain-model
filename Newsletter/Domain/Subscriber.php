<?php

namespace Newsletter\Domain;

class Subscriber
{
    private $id;

    public function __construct(SubscriberId $id)
    {
        $this->id = $id;
    }

}