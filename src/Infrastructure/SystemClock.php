<?php

namespace Newsletter\Infrastructure;

use DateTimeImmutable;
use DateTimeZone;
use Newsletter\Domain\Clock;

final class SystemClock implements Clock
{
    public function utcNow()
    {
        return new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }
}
