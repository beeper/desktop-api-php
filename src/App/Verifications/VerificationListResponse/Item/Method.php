<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationListResponse\Item;

enum Method: string
{
    case QR = 'qr';

    case SAS = 'sas';
}
