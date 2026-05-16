<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Users\UserResolveParams;
use BeeperDesktop\Matrix\Bridges\Users\UserResolveResponse;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchParams;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\UsersRawContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class UsersRawService implements UsersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Resolve an identifier to a user on the remote network.
     *
     * @param string $identifier path param: The identifier to resolve or start a chat with
     * @param array{bridgeID: string, loginID?: string}|UserResolveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UserResolveResponse>
     *
     * @throws APIException
     */
    public function resolve(
        string $identifier,
        array|UserResolveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UserResolveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/resolve_identifier/%2$s',
                $bridgeID,
                $identifier,
            ],
            query: Util::array_transform_keys($parsed, ['loginID' => 'login_id']),
            options: $options,
            convert: UserResolveResponse::class,
        );
    }

    /**
     * @api
     *
     * Search for users on the remote network
     *
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param array{loginID?: string, query?: string}|UserSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UserSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $bridgeID,
        array|UserSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UserSearchParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['loginID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/search_users',
                $bridgeID,
            ],
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                ['loginID' => 'login_id']
            ),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: UserSearchResponse::class,
        );
    }
}
