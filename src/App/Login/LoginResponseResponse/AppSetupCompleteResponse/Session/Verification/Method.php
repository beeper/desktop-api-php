<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginResponseResponse\AppSetupCompleteResponse\Session\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
