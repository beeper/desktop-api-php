<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee;

use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeVerifyResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RecoveryCodeContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function markBackedUp(
        RequestOptions|array|null $requestOptions = null
    ): RecoveryCodeMarkBackedUpResponse;

    /**
     * @api
     *
     * @param string $recoveryCode recovery key saved by the user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $recoveryCode,
        RequestOptions|array|null $requestOptions = null
    ): RecoveryCodeVerifyResponse;
}
