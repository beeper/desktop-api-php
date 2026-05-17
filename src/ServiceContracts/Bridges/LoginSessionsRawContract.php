<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Bridges;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCancelParams;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCancelResponse;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCreateParams;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionRetrieveParams;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface LoginSessionsRawContract
{
    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param array<string,mixed>|LoginSessionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginSession>
     *
     * @throws APIException
     */
    public function create(
        string $bridgeID,
        array|LoginSessionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $loginSessionID temporary bridge login session ID
     * @param array<string,mixed>|LoginSessionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginSession>
     *
     * @throws APIException
     */
    public function retrieve(
        string $loginSessionID,
        array|LoginSessionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $loginSessionID temporary bridge login session ID
     * @param array<string,mixed>|LoginSessionCancelParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginSessionCancelResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $loginSessionID,
        array|LoginSessionCancelParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
