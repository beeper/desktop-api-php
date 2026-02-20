<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatSearchParams;

/**
 * Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
 */
enum Inbox: string
{
    case PRIMARY = 'primary';

    case LOW_PRIORITY = 'low-priority';

    case ARCHIVE = 'archive';
}
