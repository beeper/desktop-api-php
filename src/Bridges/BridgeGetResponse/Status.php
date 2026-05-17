<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\BridgeGetResponse;

/**
 * Whether this bridge can currently be used to connect new accounts.
 */
enum Status: string
{
    case AVAILABLE = 'available';

    case CONNECTED = 'connected';

    case LIMIT_REACHED = 'limit_reached';

    case TEMPORARILY_UNAVAILABLE = 'temporarily_unavailable';

    case DISABLED = 'disabled';
}
