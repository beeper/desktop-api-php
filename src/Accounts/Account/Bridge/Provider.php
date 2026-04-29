<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts\Account\Bridge;

/**
 * Bridge provider for the account. Available in Beeper Desktop v4.2.789+.
 */
enum Provider: string
{
    case CLOUD = 'cloud';

    case SELF_HOSTED = 'self-hosted';

    case LOCAL = 'local';

    case PLATFORM_SDK = 'platform-sdk';
}
