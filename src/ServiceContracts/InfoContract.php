<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Info\InfoGetResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface InfoContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): InfoGetResponse;
}
