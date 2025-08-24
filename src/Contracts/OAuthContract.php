<?php

declare(strict_types=1);

namespace BeeperDesktop\Contracts;

use BeeperDesktop\OAuth\OAuthRevokeTokenParams\TokenTypeHint;
use BeeperDesktop\OAuth\UserInfo;
use BeeperDesktop\RequestOptions;

interface OAuthContract
{
    public function getUserInfo(
        ?RequestOptions $requestOptions = null
    ): UserInfo;

    /**
     * @param string $token The token to revoke
     * @param TokenTypeHint::* $tokenTypeHint Token type hint (RFC 7009)
     */
    public function revokeToken(
        $token,
        $tokenTypeHint = null,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
