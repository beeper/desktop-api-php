<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSearchParams;

/**
 * Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
 */
enum Direction: string
{
    case AFTER = 'after';

    case BEFORE = 'before';
}
