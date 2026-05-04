<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatStartResponse;

/**
 * Only returned in start mode. 'existing' means an existing chat was reused; 'created' means a new chat was created.
 */
enum Status: string
{
    case EXISTING = 'existing';

    case CREATED = 'created';
}
