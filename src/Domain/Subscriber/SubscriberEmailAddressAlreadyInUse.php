<?php

declare(strict_types=1);

namespace Newsletter\Domain\Subscriber;

use Exception;

final class SubscriberEmailAddressAlreadyInUse extends Exception
{
}
