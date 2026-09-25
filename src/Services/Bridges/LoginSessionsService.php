<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCancelResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginSessionsContract;
use BeeperDesktop\Services\Bridges\LoginSessions\StepsService;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginSessionsService implements LoginSessionsContract
{
    /**
     * @api
     */
    public LoginSessionsRawService $raw;

    /**
     * @api
     */
    public StepsService $steps;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LoginSessionsRawService($client);
        $this->steps = new StepsService($client);
    }

    /**
     * @api
     *
     * Start a temporary bridge login session to connect a new chat account or reconnect an existing bridge login. Omit loginID and accountID to connect a new account.
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
    ): LoginSession {
        $params = Util::removeNulls(
            ['accountID' => $accountID, 'flowID' => $flowID, 'loginID' => $loginID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($bridgeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the current state of a temporary bridge login session.
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
    ): LoginSession {
        $params = Util::removeNulls(['bridgeID' => $bridgeID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($loginSessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a temporary bridge login session.
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
    ): LoginSessionCancelResponse {
        $params = Util::removeNulls(['bridgeID' => $bridgeID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($loginSessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
