<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetConfirmResponse\Session\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
