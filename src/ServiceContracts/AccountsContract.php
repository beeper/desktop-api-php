<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AccountsContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<Account>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array;
}
