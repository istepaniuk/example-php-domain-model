<?php

declare(strict_types=1);

namespace Newsletter\Tests\Infrastructure;

use Newsletter\Infrastructure\InMemorySubscriberRepository;

final class InMemorySubscriberRepositoryTest extends AbstractSubscriberRepositoryTest
{
    protected function setUp(): void
    {
        $this->repository = new InMemorySubscriberRepository();
    }
}
