<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Bridges;

use BeeperDesktop\Bridges\BridgeLogin;
use BeeperDesktop\Bridges\Logins\LoginListResponse;
use BeeperDesktop\Bridges\Logins\LoginRemoveParams\Scope;
use BeeperDesktop\Bridges\Logins\LoginRemoveResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface LoginsContract
{
    /**
     * @api
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
    ): BridgeLogin;

    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): LoginListResponse;

    /**
     * @api
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
    ): LoginRemoveResponse;
}
