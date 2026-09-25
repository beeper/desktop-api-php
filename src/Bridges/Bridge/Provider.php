<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\Bridge;

/**
 * Where accounts for this bridge run: on this device or in Beeper Cloud.
 */
enum Provider: string
{
    case CLOUD = 'cloud';

    case SELF_HOSTED = 'self-hosted';

    case LOCAL = 'local';

    case PLATFORM_SDK = 'platform-sdk';
}
