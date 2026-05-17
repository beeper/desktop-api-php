<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Bridges\BridgeGetResponse;
use BeeperDesktop\Bridges\BridgeListResponse;
use BeeperDesktop\Bridges\ProvisioningCapabilities;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface BridgesRawContract
{
    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BridgeGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BridgeListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $bridgeID bridge ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProvisioningCapabilities>
     *
     * @throws APIException
     */
    public function retrieveCapabilities(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
