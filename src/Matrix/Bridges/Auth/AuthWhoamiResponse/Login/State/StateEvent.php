<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login\State;

/**
 * The current state of this login.
 */
enum StateEvent: string
{
    case CONNECTING = 'CONNECTING';

    case CONNECTED = 'CONNECTED';

    case TRANSIENT_DISCONNECT = 'TRANSIENT_DISCONNECT';

    case BAD_CREDENTIALS = 'BAD_CREDENTIALS';

    case UNKNOWN_ERROR = 'UNKNOWN_ERROR';
}
