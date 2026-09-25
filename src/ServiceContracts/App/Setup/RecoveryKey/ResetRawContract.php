<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Setup\RecoveryKey;

use BeeperDesktop\App\Setup\RecoveryKey\Reset\ResetConfirmParams;
use BeeperDesktop\App\Setup\RecoveryKey\Reset\ResetConfirmResponse;
use BeeperDesktop\App\Setup\RecoveryKey\Reset\ResetCreateParams;
use BeeperDesktop\App\Setup\RecoveryKey\Reset\ResetNewResponse;
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
