<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Users\UserGetProfileResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface UsersContract
{
    /**
     * @api
     *
     * @param string $userID the user whose profile information to get
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveProfile(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): UserGetProfileResponse;
}
