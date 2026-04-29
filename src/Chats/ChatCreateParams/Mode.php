<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams;

/**
 * Operation mode. Use 'start' to resolve a user/contact and start a direct chat. Omit or set 'create' to create a chat directly.
 */
enum Mode: string
{
    case START = 'start';

    case CREATE = 'create';
}
