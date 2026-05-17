<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\App\AppSessionResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\AppContract;
use BeeperDesktop\Services\App\LoginService;
use BeeperDesktop\Services\App\VerificationsService;

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
    public VerificationsService $verifications;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AppRawService($client);
        $this->login = new LoginService($client);
        $this->verifications = new VerificationsService($client);
    }

    /**
     * @api
     *
     * Return the current Beeper Desktop or Beeper Server sign-in and encrypted messaging setup state. This endpoint is public before sign-in so apps can discover that sign-in is needed; after sign-in, pass a read token.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function session(
        RequestOptions|array|null $requestOptions = null
    ): AppSessionResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->session(requestOptions: $requestOptions);

        return $response->parse();
    }
}
