<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Bridges\LoginFlows\LoginFlowListResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginFlowsContract;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginFlowsService implements LoginFlowsContract
{
    /**
     * @api
     */
    public LoginFlowsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LoginFlowsRawService($client);
    }

    /**
     * @api
     *
     * List connect and reconnect flow options for a bridge. Use a flowID when creating a bridge login session.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): LoginFlowListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($bridgeID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
