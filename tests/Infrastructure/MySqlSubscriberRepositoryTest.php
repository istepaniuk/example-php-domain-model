<?php

declare(strict_types=1);

namespace Newsletter\Tests\Infrastructure;

use Newsletter\Infrastructure\MySqlSubscriberRepository;

/** @group integration */
final class MySqlSubscriberRepositoryTest extends AbstractSubscriberRepositoryTest
{
    protected function setUp(): void
    {
        $this->repository = new MySqlSubscriberRepository('mysql://localhost');
    }
}
