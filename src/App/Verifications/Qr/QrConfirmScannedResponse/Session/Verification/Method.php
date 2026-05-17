<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Session\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
