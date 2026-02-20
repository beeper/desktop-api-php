<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSearchParams;

/**
 * Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
 */
enum Sender: string
{
    case ME = 'me';

    case OTHERS = 'others';
}
