<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Bridges\BridgeGetResponse;
use BeeperDesktop\Bridges\BridgeListResponse;
use BeeperDesktop\Bridges\ProvisioningCapabilities;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\BridgesContract;
use BeeperDesktop\Services\Bridges\ConnectionsService;
use BeeperDesktop\Services\Bridges\LoginFlowsService;
use BeeperDesktop\Services\Bridges\LoginSessionsService;

/**
 * Manage bridge-backed account types, connections, and login sessions.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class BridgesService implements BridgesContract
{
    /**
     * @api
     */
    public BridgesRawService $raw;

    /**
     * @api
     */
    public LoginFlowsService $loginFlows;

    /**
     * @api
     */
    public ConnectionsService $connections;

    /**
     * @api
     */
    public LoginSessionsService $loginSessions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BridgesRawService($client);
        $this->loginFlows = new LoginFlowsService($client);
        $this->connections = new ConnectionsService($client);
        $this->loginSessions = new LoginSessionsService($client);
    }

    /**
     * @api
     *
     * Get one bridge, including the chat accounts connected through it.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BridgeGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($bridgeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List available bridges. A bridge is a chat-network connector that can connect or reconnect chat accounts. Connected accounts use the same Account schema as GET /v1/accounts.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BridgeListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get advanced network capabilities for a bridge. This endpoint is intended for clients that build custom connect or chat-creation flows.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveCapabilities(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): ProvisioningCapabilities {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveCapabilities($bridgeID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
