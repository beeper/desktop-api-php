<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSearchParams;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
 */
final class Sender implements ConverterSource
{
    use SdkEnum;

    public const ME = 'me';

    public const OTHERS = 'others';
}
