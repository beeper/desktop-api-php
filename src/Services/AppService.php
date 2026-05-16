<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\App\AppStatusResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\AppContract;
use BeeperDesktop\Services\App\E2eeService;
use BeeperDesktop\Services\App\LoginService;

/**
 * Manage Beeper app login and encrypted messaging setup.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AppService implements AppContract
{
    /**
     * @api
     */
    public AppRawService $raw;

    /**
     * @api
     */
    public LoginService $login;

    /**
     * @api
     */
    public E2eeService $e2ee;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AppRawService($client);
        $this->login = new LoginService($client);
        $this->e2ee = new E2eeService($client);
    }

    /**
     * @api
     *
     * Return the current Beeper Desktop sign-in and encrypted messaging setup state. This endpoint is public before sign-in so apps can discover that login is needed; after sign-in, pass a read token.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function status(
        RequestOptions|array|null $requestOptions = null
    ): AppStatusResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->status(requestOptions: $requestOptions);

        return $response->parse();
    }
}
