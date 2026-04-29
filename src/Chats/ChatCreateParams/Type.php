<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams;

/**
 * Required for create mode. 'single' creates a direct message chat; 'group' creates a group chat.
 */
enum Type: string
{
    case SINGLE = 'single';

    case GROUP = 'group';
}
