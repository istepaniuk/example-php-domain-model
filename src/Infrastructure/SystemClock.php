<?php

declare(strict_types=1);

namespace Newsletter\Infrastructure;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Newsletter\Domain\Clock;

final class SystemClock implements Clock
{
    private DateTimeZone $timezone;

    public function __construct()
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function utcNow(): DateTimeInterface
    {
        return new DateTimeImmutable('now', $this->timezone);
    }
}
