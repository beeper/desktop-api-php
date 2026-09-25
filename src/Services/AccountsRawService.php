<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\Accounts\AccountGetResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Conversion\ListOf;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\AccountsRawContract;

/**
 * Manage connected chat accounts.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AccountsRawService implements AccountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get one chat account connected to this Beeper Client API server.
     *
     * @param string $accountID account ID this resource belongs to
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/accounts/%1$s', $accountID],
            options: $requestOptions,
            convert: AccountGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List chat accounts connected to this Beeper Client API server, including bridge, network, user identity, and connection status.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<Account>>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts',
            options: $requestOptions,
            convert: new ListOf(Account::class),
        );
    }
}
