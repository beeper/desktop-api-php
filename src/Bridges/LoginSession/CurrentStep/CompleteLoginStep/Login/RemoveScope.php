<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep\CompleteLoginStep\Login;

/**
 * Where this bridge login should be removed.
 */
enum RemoveScope: string
{
    case CURRENT_DEVICE = 'current-device';

    case ALL_DEVICES = 'all-devices';
}
