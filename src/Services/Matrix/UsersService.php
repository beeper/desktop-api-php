<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Users\UserGetProfileResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\UsersContract;
use BeeperDesktop\Services\Matrix\Users\AccountDataService;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class UsersService implements UsersContract
{
    /**
     * @api
     */
    public UsersRawService $raw;

    /**
     * @api
     */
    public AccountDataService $accountData;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsersRawService($client);
        $this->accountData = new AccountDataService($client);
    }

    /**
     * @api
     *
     * Get the complete profile for a user.
     *
     * @param string $userID the user whose profile information to get
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveProfile(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): UserGetProfileResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveProfile($userID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
