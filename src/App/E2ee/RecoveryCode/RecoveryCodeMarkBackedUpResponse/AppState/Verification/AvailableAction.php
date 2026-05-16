<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse\AppState\Verification;

enum AvailableAction: string
{
    case CREATE = 'create';

    case QR_SCAN = 'qr.scan';

    case ACCEPT = 'accept';

    case CANCEL = 'cancel';

    case QR_CONFIRM_SCANNED = 'qr.confirmScanned';

    case SAS_START = 'sas.start';

    case SAS_CONFIRM = 'sas.confirm';
}
