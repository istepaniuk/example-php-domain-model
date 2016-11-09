<?php

namespace Newsletter\Infrastructure;

use Newsletter\Domain\Clock;

class SystemClock implements Clock
{
    public function utcNow()
    {
        return new DateTime(null, new DateTimeZone("UTC"));
    }
}