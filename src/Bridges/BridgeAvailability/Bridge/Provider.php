<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\BridgeAvailability\Bridge;

/**
 * Bridge provider for the account. Available in Beeper Desktop v4.2.785+.
 */
enum Provider: string
{
    case CLOUD = 'cloud';

    case SELF_HOSTED = 'self-hosted';

    case LOCAL = 'local';

    case PLATFORM_SDK = 'platform-sdk';
}
