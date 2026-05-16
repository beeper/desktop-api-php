<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\App\AppStatusResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\AppRawContract;

/**
 * Manage Beeper app login and encrypted messaging setup.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AppRawService implements AppRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Return the current Beeper Desktop sign-in and encrypted messaging setup state. This endpoint is public before sign-in so apps can discover that login is needed; after sign-in, pass a read token.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AppStatusResponse>
     *
     * @throws APIException
     */
    public function status(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/app/status',
            options: $requestOptions,
            convert: AppStatusResponse::class,
        );
    }
}
