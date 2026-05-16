<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Sas\SaConfirmResponse;
use BeeperDesktop\App\E2ee\Verification\Sas\SaStartResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface SasRawContract
{
    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SaConfirmResponse>
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
     * @return BaseResponse<SaStartResponse>
     *
     * @throws APIException
     */
    public function start(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
