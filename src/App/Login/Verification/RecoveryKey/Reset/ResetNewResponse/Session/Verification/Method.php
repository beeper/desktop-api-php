<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetNewResponse\Session\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
