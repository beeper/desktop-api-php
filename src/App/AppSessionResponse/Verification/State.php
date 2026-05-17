<?php

declare(strict_types=1);

namespace BeeperDesktop\App\AppSessionResponse\Verification;

/**
 * Current trusted-device verification state.
 */
enum State: string
{
    case REQUESTED = 'requested';

    case READY = 'ready';

    case SAS_READY = 'sas_ready';

    case QR_SCANNED = 'qr_scanned';

    case DONE = 'done';

    case CANCELLED = 'cancelled';

    case ERROR = 'error';
}
