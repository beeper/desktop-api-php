<?php

declare(strict_types=1);

namespace BeeperDesktop\OAuth\UserInfo;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Token type.
 */
final class TokenUse implements ConverterSource
{
    use SdkEnum;

    public const ACCESS = 'access';
}
