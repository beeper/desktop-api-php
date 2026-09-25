<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Info\InfoGetResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\InfoRawContract;

/**
 * Server discovery and capability metadata. Use /v1/info before authentication setup.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class InfoRawService implements InfoRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns app, platform, server, endpoint discovery, OAuth, and WebSocket metadata for this Beeper Client API server.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InfoGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/info',
            options: $requestOptions,
            convert: InfoGetResponse::class,
            security: [],
        );
    }
}
