<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Accounts\Account;
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
     * List Chat Accounts connected to this Beeper Desktop instance, including bridge metadata and network identity.
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
