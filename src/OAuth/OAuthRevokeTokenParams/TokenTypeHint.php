<?php

declare(strict_types=1);

namespace BeeperDesktop\OAuth\OAuthRevokeTokenParams;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Token type hint (RFC 7009).
 */
final class TokenTypeHint implements ConverterSource
{
    use SdkEnum;

    public const ACCESS_TOKEN = 'access_token';
}
