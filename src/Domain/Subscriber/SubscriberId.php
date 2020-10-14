<?php

declare(strict_types=1);

namespace Newsletter\Domain\Subscriber;

use Rhumsaa\Uuid\Uuid;

final class SubscriberId
{
    private string $id;

    protected function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public static function generate(): self
    {
        $uuid = Uuid::uuid4();

        return new self((string) $uuid);
    }

    public function equals(self $other): bool
    {
        return $this->id == $other->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
