<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationGetResponse\Session;

/**
 * Current sign-in and encrypted messaging setup state for Beeper Desktop or Beeper Server.
 */
enum State: string
{
    case NEEDS_LOGIN = 'needs-login';

    case INITIALIZING = 'initializing';

    case NEEDS_CROSS_SIGNING_SETUP = 'needs-cross-signing-setup';

    case NEEDS_VERIFICATION = 'needs-verification';

    case NEEDS_SECRETS = 'needs-secrets';

    case NEEDS_FIRST_SYNC = 'needs-first-sync';

    case READY = 'ready';
}
