<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts\AccountGetResponse;

/**
 * Current connection status for this account.
 */
enum Status: string
{
    case CONNECTED = 'connected';

    case CONNECTING = 'connecting';

    case BACKFILLING = 'backfilling';

    case CONNECTION_REQUIRED = 'connection_required';

    case RECONNECT_REQUIRED = 'reconnect_required';

    case ATTENTION_REQUIRED = 'attention_required';

    case DISCONNECTED = 'disconnected';

    case DISABLED = 'disabled';
}
