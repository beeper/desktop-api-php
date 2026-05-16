<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee\RecoveryCode;

use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetConfirmParams;
use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetConfirmResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetCreateParams;
use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetNewResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ResetRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ResetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResetNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ResetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ResetConfirmParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResetConfirmResponse>
     *
     * @throws APIException
     */
    public function confirm(
        array|ResetConfirmParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
