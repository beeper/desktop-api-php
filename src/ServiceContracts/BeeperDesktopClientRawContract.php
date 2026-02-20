<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceFocusResponse;
use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse;
use BeeperDesktop\BeeperDesktopFocusParams;
use BeeperDesktop\BeeperDesktopSearchParams;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface BeeperDesktopClientRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BeeperDesktopFocusParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BeeperDesktopClientServiceFocusResponse>
     *
     * @throws APIException
     */
    public function focus(
        array|BeeperDesktopFocusParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BeeperDesktopSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BeeperDesktopClientServiceSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|BeeperDesktopSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
