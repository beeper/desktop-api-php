<?php

declare(strict_types=1);

namespace BeeperDesktop\Contracts;

use BeeperDesktop\Accounts\AccountsResponse;
use BeeperDesktop\RequestOptions;

interface AccountsContract
{
    public function list(
        ?RequestOptions $requestOptions = null
    ): AccountsResponse;
}
