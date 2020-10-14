<?php

declare(strict_types=1);

namespace Newsletter\Tests\Application;

use DateTimeInterface;
use Newsletter\Domain\Clock;

final class FakeClock implements Clock
{
    private DateTimeInterface $fixedAt;

    public function __construct(DateTimeInterface $fixedAt)
    {
        $this->fixedAt = $fixedAt;
    }

    public function utcNow(): DateTimeInterface
    {
        return $this->fixedAt;
    }
}
