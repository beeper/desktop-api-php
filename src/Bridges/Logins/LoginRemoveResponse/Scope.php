<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\Logins\LoginRemoveResponse;

/**
 * Where this bridge login should be removed.
 */
enum Scope: string
{
    case CURRENT_DEVICE = 'current-device';

    case ALL_DEVICES = 'all-devices';
}
