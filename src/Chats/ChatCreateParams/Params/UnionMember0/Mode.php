<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0;

/**
 * Operation mode. Use 'start' to resolve a user/contact and start a direct chat.
 */
enum Mode: string
{
    case START = 'start';
}
