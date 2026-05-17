<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\SAS\SASStartResponse\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
