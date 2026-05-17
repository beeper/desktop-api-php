<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\SAS\SASConfirmResponse\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
