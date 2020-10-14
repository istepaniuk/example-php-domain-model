<?php

declare(strict_types=1);

namespace Newsletter\Domain;

final class Newsletter
{
    private string $subject;
    private string $body;

    private function __construct(string $subject, string $body)
    {
        if (empty($subject) || empty($body)) {
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
