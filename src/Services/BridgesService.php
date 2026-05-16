<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Bridges\BridgeListResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\BridgesContract;

/**
 * Manage bridge-backed account types and account availability.
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
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BridgesRawService($client);
    }

    /**
     * @api
     *
     * List bridge-backed account types that can be shown in add-account flows, grouped with connected accounts that use the same Account schema as GET /v1/accounts.
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
}
