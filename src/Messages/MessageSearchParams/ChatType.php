<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSearchParams;

/**
 * Filter by chat type: 'group' for group chats, 'single' for 1:1 chats.
 */
enum ChatType: string
{
    case GROUP = 'group';

    case SINGLE = 'single';
}
