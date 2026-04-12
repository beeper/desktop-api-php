<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember1;

/**
 * 'single' requires exactly one participantID; 'group' supports multiple participants and optional title.
 */
enum Type: string
{
    case SINGLE = 'single';

    case GROUP = 'group';
}
