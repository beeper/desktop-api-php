<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Setup\Verifications\QR\QRScanResponse\Session\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
