<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Users;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Users\AccountData\AccountDataRetrieveParams;
use BeeperDesktop\Matrix\Users\AccountData\AccountDataUpdateParams;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Users\AccountDataRawContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AccountDataRawService implements AccountDataRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get some account data for the client. This config is only visible to the user
     * that set the account data.
     *
     * @param string $type The event type of the account data to get. Custom types should be
     * namespaced to avoid clashes.
     * @param array{userID: string}|AccountDataRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $type,
        array|AccountDataRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountDataRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['_matrix/client/v3/user/%1$s/account_data/%2$s', $userID, $type],
            options: $options,
            convert: 'mixed',
        );
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
     * @param array{userID: string, body: mixed}|AccountDataUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $type,
        array|AccountDataUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountDataUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        /** @var array<string,mixed> */
        $body = $parsed['body'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['_matrix/client/v3/user/%1$s/account_data/%2$s', $userID, $type],
            body: array_diff_key($body, array_flip(['userID'])),
            options: $options,
            convert: 'mixed',
        );
    }
}
