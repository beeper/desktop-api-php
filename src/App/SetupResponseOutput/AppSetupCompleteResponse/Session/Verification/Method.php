<?php

declare(strict_types=1);

namespace BeeperDesktop\App\SetupResponseOutput\AppSetupCompleteResponse\Session\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
