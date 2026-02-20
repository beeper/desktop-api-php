<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams\Chat;

/**
 * Operation mode. Defaults to 'create' when omitted.
 */
enum Mode: string
{
    case CREATE = 'create';

    case START = 'start';
}
