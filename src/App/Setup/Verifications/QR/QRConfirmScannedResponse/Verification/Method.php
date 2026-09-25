<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
