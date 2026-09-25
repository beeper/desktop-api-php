<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Bridges\LoginFlows\LoginFlowListResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginFlowsRawContract;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginFlowsRawService implements LoginFlowsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List connect and reconnect flow options for a bridge. Use a flowID when creating a bridge login session.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginFlowListResponse>
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
            path: ['v1/bridges/%1$s/login-flows', $bridgeID],
            options: $requestOptions,
            convert: LoginFlowListResponse::class,
        );
    }
}
