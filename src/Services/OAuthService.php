<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Contracts\OAuthContract;
use BeeperDesktop\Core\Conversion;
use BeeperDesktop\Core\Util;
use BeeperDesktop\OAuth\OAuthRevokeTokenParams;
use BeeperDesktop\OAuth\OAuthRevokeTokenParams\TokenTypeHint;
use BeeperDesktop\OAuth\UserInfo;
use BeeperDesktop\RequestOptions;

/**
 * OAuth2 authentication and token management.
 */
final class OAuthService implements OAuthContract
{
    public function __construct(private Client $client) {}

    /**
     * Returns information about the authenticated user/token.
     */
    public function getUserInfo(
        ?RequestOptions $requestOptions = null
    ): UserInfo {
        $resp = $this->client->request(
            method: 'get',
            path: 'oauth/userinfo',
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(UserInfo::class, value: $resp);
    }

    /**
     * Revoke an access token or refresh token (RFC 7009).
     *
     * @param string $token The token to revoke
     * @param TokenTypeHint::* $tokenTypeHint Token type hint (RFC 7009)
     */
    public function revokeToken(
        $token,
        $tokenTypeHint = null,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $args = ['token' => $token, 'tokenTypeHint' => $tokenTypeHint];
        $args = Util::array_filter_null($args, ['tokenTypeHint']);
        [$parsed, $options] = OAuthRevokeTokenParams::parseRequest(
            $args,
            $requestOptions
        );

        return $this->client->request(
            method: 'post',
            path: 'oauth/revoke',
            body: (object) $parsed,
            options: $options,
        );
    }
}
