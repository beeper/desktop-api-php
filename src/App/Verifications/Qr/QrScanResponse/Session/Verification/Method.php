<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\Qr\QrScanResponse\Session\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
