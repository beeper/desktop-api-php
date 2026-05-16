<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\App\AppStatusResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AppContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function status(
        RequestOptions|array|null $requestOptions = null
    ): AppStatusResponse;
}
