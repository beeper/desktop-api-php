<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Users;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AccountDataContract
{
    /**
     * @api
     *
     * @param string $type The event type of the account data to get. Custom types should be
     * namespaced to avoid clashes.
     * @param string $userID The ID of the user to get account data for. The access token must be
     * authorized to make requests for this user ID.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $type,
        string $userID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $type Path param: The event type of the account data to set. Custom types should be
     * namespaced to avoid clashes.
     * @param string $userID Path param: The ID of the user to set account data for. The access token must be
     * authorized to make requests for this user ID.
     * @param mixed $body Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $type,
        string $userID,
        mixed $body,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
