<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\BridgeAvailability;

/**
 * Whether this bridge can currently be used to add an account.
 */
enum Status: string
{
    case AVAILABLE = 'available';

    case CONNECTED = 'connected';

    case LIMIT_REACHED = 'limit_reached';

    case TEMPORARILY_UNAVAILABLE = 'temporarily_unavailable';
}
