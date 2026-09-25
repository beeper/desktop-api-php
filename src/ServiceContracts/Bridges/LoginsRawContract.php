<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Bridges;

use BeeperDesktop\Bridges\BridgeLogin;
use BeeperDesktop\Bridges\Logins\LoginListResponse;
use BeeperDesktop\Bridges\Logins\LoginRemoveParams;
use BeeperDesktop\Bridges\Logins\LoginRemoveResponse;
use BeeperDesktop\Bridges\Logins\LoginRetrieveParams;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface LoginsRawContract
{
    /**
     * @api
     *
     * @param string $loginID bridge login ID
     * @param array<string,mixed>|LoginRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $loginID path param: Bridge login ID
     * @param array<string,mixed>|LoginRemoveParams $params
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
    ): BaseResponse;
}
