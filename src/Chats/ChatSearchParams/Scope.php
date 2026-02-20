<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatSearchParams;

/**
 * Search scope: 'titles' matches title + network; 'participants' matches participant names.
 */
enum Scope: string
{
    case TITLES = 'titles';

    case PARTICIPANTS = 'participants';
}
