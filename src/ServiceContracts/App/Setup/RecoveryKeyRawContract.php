<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Setup;

use BeeperDesktop\App\Setup\RecoveryKey\RecoveryKeyVerifyParams;
use BeeperDesktop\App\Setup\RecoveryKey\RecoveryKeyVerifyResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RecoveryKeyRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RecoveryKeyVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RecoveryKeyVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|RecoveryKeyVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
