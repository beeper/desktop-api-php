<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Bridges\BridgeLogin;
use BeeperDesktop\Bridges\Logins\LoginListResponse;
use BeeperDesktop\Bridges\Logins\LoginRemoveParams\Scope;
use BeeperDesktop\Bridges\Logins\LoginRemoveResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginsContract;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginsService implements LoginsContract
{
    /**
     * @api
     */
    public LoginsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LoginsRawService($client);
    }

    /**
     * @api
     *
     * Get one bridge login.
     *
     * @param string $loginID bridge login ID
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $loginID,
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null,
    ): BridgeLogin {
        $params = Util::removeNulls(['bridgeID' => $bridgeID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($loginID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List bridge logins. A bridge login is a signed-in identity for a bridge and can contain one or more chat accounts.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): LoginListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($bridgeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a bridge login from this device or, when supported by the bridge, from all devices.
     *
     * @param string $loginID path param: Bridge login ID
     * @param string $bridgeID path param: Bridge ID
     * @param Scope|value-of<Scope> $scope body param: Where this bridge login should be removed
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function remove(
        string $loginID,
        string $bridgeID,
        Scope|string $scope,
        RequestOptions|array|null $requestOptions = null,
    ): LoginRemoveResponse {
        $params = Util::removeNulls(['bridgeID' => $bridgeID, 'scope' => $scope]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->remove($loginID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
