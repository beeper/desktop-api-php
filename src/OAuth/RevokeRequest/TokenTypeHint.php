<?php

declare(strict_types=1);

namespace BeeperDesktop\OAuth\RevokeRequest;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Hint about the type of token being revoked.
 */
final class TokenTypeHint implements ConverterSource
{
    use SdkEnum;

    public const ACCESS_TOKEN = 'access_token';

    public const REFRESH_TOKEN = 'refresh_token';
}
