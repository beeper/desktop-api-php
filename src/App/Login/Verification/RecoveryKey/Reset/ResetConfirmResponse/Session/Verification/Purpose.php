<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetConfirmResponse\Session\Verification;

/**
 * Why this verification exists.
 */
enum Purpose: string
{
    case LOGIN = 'login';

    case DEVICE = 'device';
}
