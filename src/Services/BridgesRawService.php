<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Bridges\BridgeGetResponse;
use BeeperDesktop\Bridges\BridgeListResponse;
use BeeperDesktop\Bridges\ProvisioningCapabilities;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\BridgesRawContract;

/**
 * Manage bridge-backed account types, connections, and login sessions.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class BridgesRawService implements BridgesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get one bridge, including the chat accounts connected through it.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BridgeGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/bridges/%1$s', $bridgeID],
            options: $requestOptions,
            convert: BridgeGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List available bridges. A bridge is a chat-network connector that can connect or reconnect chat accounts. Connected accounts use the same Account schema as GET /v1/accounts.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BridgeListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/bridges',
            options: $requestOptions,
            convert: BridgeListResponse::class,
        );
    }

    /**
     * @api
     *
     * Get advanced network capabilities for a bridge. This endpoint is intended for clients that build custom connect or chat-creation flows.
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProvisioningCapabilities>
     *
     * @throws APIException
     */
    public function retrieveCapabilities(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/bridges/%1$s/capabilities', $bridgeID],
            options: $requestOptions,
            convert: ProvisioningCapabilities::class,
        );
    }
}
