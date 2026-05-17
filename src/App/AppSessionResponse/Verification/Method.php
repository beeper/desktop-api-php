<?php

declare(strict_types=1);

namespace BeeperDesktop\App\AppSessionResponse\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
