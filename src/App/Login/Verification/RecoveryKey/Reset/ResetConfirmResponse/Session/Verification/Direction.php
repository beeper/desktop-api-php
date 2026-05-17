<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetConfirmResponse\Session\Verification;

/**
 * Whether this device started or received the verification.
 */
enum Direction: string
{
    case INCOMING = 'incoming';

    case OUTGOING = 'outgoing';
}
