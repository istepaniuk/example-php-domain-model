<?php

namespace Newsletter\Domain;

class Newsletter
{
    private $subject;
    private $body;

    public function __construct($subject, $body)
    {
        if (!$subject || !$body) {
            throw new \InvalidArgumentException(
                "Both subject and body name are mandatory");
        }
        $this->subject = $subject;
        $this->body = $body;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getBody()
    {
        return $this->body;
    }

}