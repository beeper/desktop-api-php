<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Bridges;

use BeeperDesktop\Bridges\LoginFlows\LoginFlowListResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface LoginFlowsContract
{
    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): LoginFlowListResponse;
}
