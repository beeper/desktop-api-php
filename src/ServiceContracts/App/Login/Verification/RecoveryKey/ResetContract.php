<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKey;

use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetConfirmResponse;
use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetNewResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ResetContract
{
    /**
     * @api
     *
     * @param string $existingRecoveryKey existing recovery key, if the user has it
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $existingRecoveryKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): ResetNewResponse;

    /**
     * @api
     *
     * @param string $recoveryKey new recovery key returned by the reset step
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirm(
        string $recoveryKey,
        RequestOptions|array|null $requestOptions = null
    ): ResetConfirmResponse;
}
