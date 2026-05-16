<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee\RecoveryCode;

use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetConfirmResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetNewResponse;
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
     * @param string $recoveryCode existing recovery key, if the user has it
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $recoveryCode = null,
        RequestOptions|array|null $requestOptions = null,
    ): ResetNewResponse;

    /**
     * @api
     *
     * @param string $recoveryCode new recovery key returned by the reset step
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirm(
        string $recoveryCode,
        RequestOptions|array|null $requestOptions = null
    ): ResetConfirmResponse;
}
