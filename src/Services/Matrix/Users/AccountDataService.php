<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Users;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Users\AccountDataContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AccountDataService implements AccountDataContract
{
    /**
     * @api
     */
    public AccountDataRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountDataRawService($client);
    }

    /**
     * @api
     *
     * Get some account data for the client. This config is only visible to the user
     * that set the account data.
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
    ): mixed {
        $params = Util::removeNulls(['userID' => $userID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($type, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Set some account data for the client. This config is only visible to the user
     * that set the account data. The config will be available to clients through the
     * top-level `account_data` field in the homeserver response to
     * [/sync](https://spec.matrix.org/v1.18/client-server-api/#get_matrixclientv3sync).
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
    ): mixed {
        $params = Util::removeNulls(['userID' => $userID, 'body' => $body]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($type, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
