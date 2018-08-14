<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Clock;

class SystemClock implements Clock
{
    public function utcNow()
    {
        return new \DateTimeImmutable(null, new \DateTimeZone("UTC"));
    }
}