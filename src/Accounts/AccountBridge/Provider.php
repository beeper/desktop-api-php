<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts\AccountBridge;

/**
 * Where this account runs: on this device or in Beeper Cloud. Available in Beeper Desktop v4.2.785+.
 */
enum Provider: string
{
    case CLOUD = 'cloud';

    case SELF_HOSTED = 'self-hosted';

    case LOCAL = 'local';

    case PLATFORM_SDK = 'platform-sdk';
}
