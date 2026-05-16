<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Users\UserGetProfileResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\UsersRawContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class UsersRawService implements UsersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the complete profile for a user.
     *
     * @param string $userID the user whose profile information to get
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UserGetProfileResponse>
     *
     * @throws APIException
     */
    public function retrieveProfile(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['_matrix/client/v3/profile/%1$s', $userID],
            options: $requestOptions,
            convert: UserGetProfileResponse::class,
        );
    }
}
