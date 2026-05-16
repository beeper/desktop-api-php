<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Sas\SaConfirmResponse;
use BeeperDesktop\App\E2ee\Verification\Sas\SaStartResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface SasContract
{
    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirm(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): SaConfirmResponse;

    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): SaStartResponse;
}
