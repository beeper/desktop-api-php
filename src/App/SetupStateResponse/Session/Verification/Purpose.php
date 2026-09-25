<?php

declare(strict_types=1);

namespace BeeperDesktop\App\SetupStateResponse\Session\Verification;

/**
 * Why this verification exists.
 */
enum Purpose: string
{
    case LOGIN = 'login';

    case DEVICE = 'device';
}
