<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Verifications;

use BeeperDesktop\App\Verifications\SAS\SASConfirmResponse;
use BeeperDesktop\App\Verifications\SAS\SASStartResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface SASRawContract
{
    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SASConfirmResponse>
     *
     * @throws APIException
     */
    public function confirm(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SASStartResponse>
     *
     * @throws APIException
     */
    public function start(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
