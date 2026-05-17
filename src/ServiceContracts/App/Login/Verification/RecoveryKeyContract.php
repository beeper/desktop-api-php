<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Login\Verification;

use BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RecoveryKeyContract
{
    /**
     * @api
     *
     * @param string $recoveryKey recovery key saved by the user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $recoveryKey,
        RequestOptions|array|null $requestOptions = null
    ): RecoveryKeyVerifyResponse;
}
