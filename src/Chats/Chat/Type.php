<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

/**
 * Chat type: 'single' for direct messages, 'group' for group chats.
 */
enum Type: string
{
    case SINGLE = 'single';

    case GROUP = 'group';
}
