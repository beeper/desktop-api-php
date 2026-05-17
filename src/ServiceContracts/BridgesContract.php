<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Bridges\BridgeGetResponse;
use BeeperDesktop\Bridges\BridgeListResponse;
use BeeperDesktop\Bridges\ProvisioningCapabilities;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface BridgesContract
{
    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BridgeGetResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BridgeListResponse;

    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveCapabilities(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): ProvisioningCapabilities;
}
