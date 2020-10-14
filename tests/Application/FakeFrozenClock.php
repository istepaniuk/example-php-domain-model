<?php

declare(strict_types=1);

namespace Newsletter\Tests\Application;

use DateTimeImmutable;
use DateTimeInterface;
use Newsletter\Domain\Clock;

final class FakeFrozenClock implements Clock
{
    public function utcNow(): DateTimeInterface
    {
        return new DateTimeImmutable('2020-03-30 02:05:00');
    }
}
