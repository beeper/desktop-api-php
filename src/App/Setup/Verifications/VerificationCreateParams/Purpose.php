<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Setup\Verifications\VerificationCreateParams;

/**
 * Why this verification is being started.
 */
enum Purpose: string
{
    case LOGIN = 'login';

    case DEVICE = 'device';
}
