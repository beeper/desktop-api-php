<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatSearchParams;

/**
 * Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, or "any" to get all types.
 */
enum Type: string
{
    case SINGLE = 'single';

    case GROUP = 'group';

    case ANY = 'any';
}
