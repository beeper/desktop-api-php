<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\App\AppSessionResponse;
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
     * Return the current Beeper Desktop or Beeper Server sign-in and encrypted messaging setup state. This endpoint is public before sign-in so apps can discover that sign-in is needed; after sign-in, pass a read token.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AppSessionResponse>
     *
     * @throws APIException
     */
    public function session(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/app/setup',
            options: $requestOptions,
            convert: AppSessionResponse::class,
        );
    }
}
