<?php

declare(strict_types=1);

namespace Newsletter\Domain;

use DateTimeInterface;

interface Clock
{
    public function utcNow(): DateTimeInterface;
}
