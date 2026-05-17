<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Bridges;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCancelResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface LoginSessionsContract
{
    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param string $accountID Existing chat account ID to reconnect. Omit to connect a new account.
     * @param string $flowID Optional flow ID returned by the list login flows endpoint. If omitted, Beeper chooses the default flow.
     * @param string $loginID Existing bridge login ID to reconnect. Omit to connect a new account.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $bridgeID,
        ?string $accountID = null,
        ?string $flowID = null,
        ?string $loginID = null,
        RequestOptions|array|null $requestOptions = null,
    ): LoginSession;

    /**
     * @api
     *
     * @param string $loginSessionID temporary bridge login session ID
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $loginSessionID,
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null,
    ): LoginSession;

    /**
     * @api
     *
     * @param string $loginSessionID temporary bridge login session ID
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $loginSessionID,
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null,
    ): LoginSessionCancelResponse;
}
