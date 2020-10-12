<?php

namespace Newsletter\Domain;

final class Newsletter
{
    private $subject;
    private $body;

    private function __construct(string $subject, string $body)
    {
        if (!$subject || !$body) {
            throw new \InvalidArgumentException('Both subject and body name are mandatory');
        }
        $this->subject = $subject;
        $this->body = $body;
    }

    public static function fromStrings(string $subject, string $body): self
    {
        return new self($subject, $body);
    }

    public function subject(): string
    {
        return $this->subject;
    }

    public function body(): string
    {
        return $this->body;
    }
}
