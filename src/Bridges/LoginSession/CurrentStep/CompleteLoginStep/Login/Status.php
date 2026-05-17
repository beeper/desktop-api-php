<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep\CompleteLoginStep\Login;

enum Status: string
{
    case CONNECTED = 'connected';

    case CONNECTING = 'connecting';

    case NEEDS_LOGIN = 'needs_login';

    case LOGGED_OUT = 'logged_out';

    case UNKNOWN = 'unknown';
}
