<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginRegisterResponse\AppState;

/**
 * Current onboarding state for Beeper Desktop.
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
