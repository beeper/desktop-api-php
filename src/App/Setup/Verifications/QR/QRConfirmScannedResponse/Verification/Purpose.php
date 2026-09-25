<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse\Verification;

/**
 * Why this verification exists.
 */
enum Purpose: string
{
    case LOGIN = 'login';

    case DEVICE = 'device';
}
