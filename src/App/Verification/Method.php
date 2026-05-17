<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
