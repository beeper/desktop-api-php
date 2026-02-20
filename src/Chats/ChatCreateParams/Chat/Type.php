<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams\Chat;

/**
 * Required when mode='create'. 'single' requires exactly one participantID; 'group' supports multiple participants and optional title.
 */
enum Type: string
{
    case SINGLE = 'single';

    case GROUP = 'group';
}
