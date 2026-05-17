<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatStartResponse;

/**
 * DEPRECATED - legacy start-chat status for older clients. New clients should inspect the returned Chat instead.
 *
 * @deprecated inspect the returned Chat instead
 */
enum Status: string
{
    case EXISTING = 'existing';

    case CREATED = 'created';
}
