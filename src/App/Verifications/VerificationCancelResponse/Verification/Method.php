<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationCancelResponse\Verification;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
