<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Verifications;

use BeeperDesktop\App\Verifications\SAS\SASConfirmResponse;
use BeeperDesktop\App\Verifications\SAS\SASStartResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface SASContract
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
    ): SASConfirmResponse;

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
    ): SASStartResponse;
}
