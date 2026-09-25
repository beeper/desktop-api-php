<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatSearchParams;

/**
 * Filter by inbox type: "primary" (the chats the Beeper inbox shows: non-archived, non-low-priority, honoring inbox visibility rules and labels), "low-priority", or "archive". If not specified, shows all chats.
 */
enum Inbox: string
{
    case PRIMARY = 'primary';

    case LOW_PRIORITY = 'low-priority';

    case ARCHIVE = 'archive';
}
