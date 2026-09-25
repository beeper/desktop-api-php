<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Bridges\BridgeLogin;
use BeeperDesktop\Bridges\Logins\LoginListResponse;
use BeeperDesktop\Bridges\Logins\LoginRemoveParams;
use BeeperDesktop\Bridges\Logins\LoginRemoveParams\Scope;
use BeeperDesktop\Bridges\Logins\LoginRemoveResponse;
use BeeperDesktop\Bridges\Logins\LoginRetrieveParams;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginsRawContract;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginsRawService implements LoginsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get one bridge login.
     *
     * @param string $loginID bridge login ID
     * @param array{bridgeID: string}|LoginRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BridgeLogin>
     *
     * @throws APIException
     */
    public function retrieve(
        string $loginID,
        array|LoginRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LoginRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/bridges/%1$s/logins/%2$s', $bridgeID, $loginID],
            options: $options,
            convert: BridgeLogin::class,
        );
    }

    /**
     * @api
     *
     * List bridge logins. A bridge login is a signed-in identity for a bridge and can contain one or more chat accounts.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/bridges/%1$s/logins', $bridgeID],
            options: $requestOptions,
            convert: LoginListResponse::class,
        );
    }

    /**
     * @api
     *
     * Remove a bridge login from this device or, when supported by the bridge, from all devices.
     *
     * @param string $loginID path param: Bridge login ID
     * @param array{
     *   bridgeID: string, scope: Scope|value-of<Scope>
     * }|LoginRemoveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginRemoveResponse>
     *
     * @throws APIException
     */
    public function remove(
        string $loginID,
        array|LoginRemoveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LoginRemoveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/bridges/%1$s/logins/%2$s/remove', $bridgeID, $loginID],
            body: (object) array_diff_key($parsed, array_flip(['bridgeID'])),
            options: $options,
            convert: LoginRemoveResponse::class,
        );
    }
}
