<?php

declare(strict_types=1);

namespace BeeperDesktop\SendStatus;

/**
 * Current status of the message send attempt.
 */
enum Status: string
{
    case SUCCESS = 'SUCCESS';

    case PENDING = 'PENDING';

    case FAIL_RETRIABLE = 'FAIL_RETRIABLE';

    case FAIL_PERMANENT = 'FAIL_PERMANENT';
}
