<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts\Contacts\ContactListParams;

/**
 * Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
 */
enum Direction: string
{
    case AFTER = 'after';

    case BEFORE = 'before';
}
