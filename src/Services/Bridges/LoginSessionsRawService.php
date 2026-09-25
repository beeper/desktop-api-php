<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCancelParams;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCancelResponse;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCreateParams;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionRetrieveParams;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginSessionsRawContract;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginSessionsRawService implements LoginSessionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Start a temporary bridge login session to connect a new chat account or reconnect an existing bridge login. Omit loginID and accountID to connect a new account.
     *
     * @param string $bridgeID bridge ID
     * @param array{
     *   accountID?: string, flowID?: string, loginID?: string
     * }|LoginSessionCreateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LoginSessionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/bridges/%1$s/login-sessions', $bridgeID],
            body: (object) $parsed,
            options: $options,
            convert: LoginSession::class,
        );
    }

    /**
     * @api
     *
     * Get the current state of a temporary bridge login session.
     *
     * @param string $loginSessionID temporary bridge login session ID
     * @param array{bridgeID: string}|LoginSessionRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LoginSessionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/bridges/%1$s/login-sessions/%2$s', $bridgeID, $loginSessionID],
            options: $options,
            convert: LoginSession::class,
        );
    }

    /**
     * @api
     *
     * Cancel a temporary bridge login session.
     *
     * @param string $loginSessionID temporary bridge login session ID
     * @param array{bridgeID: string}|LoginSessionCancelParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LoginSessionCancelParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/bridges/%1$s/login-sessions/%2$s', $bridgeID, $loginSessionID],
            options: $options,
            convert: LoginSessionCancelResponse::class,
        );
    }
}
