<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Bridges\BridgeListResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\BridgesRawContract;

/**
 * Manage bridge-backed account types and account availability.
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
     * List bridge-backed account types that can be shown in add-account flows, grouped with connected accounts that use the same Account schema as GET /v1/accounts.
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
}
