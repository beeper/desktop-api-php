<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse\Verification;

enum AvailableAction: string
{
    case ACCEPT = 'accept';

    case CANCEL = 'cancel';

    case QR_CONFIRM_SCANNED = 'qr.confirmScanned';

    case SAS_START = 'sas.start';

    case SAS_CONFIRM = 'sas.confirm';
}
