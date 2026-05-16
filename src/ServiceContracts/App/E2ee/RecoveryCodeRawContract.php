<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee;

use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeVerifyParams;
use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeVerifyResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RecoveryCodeRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RecoveryCodeMarkBackedUpResponse>
     *
     * @throws APIException
     */
    public function markBackedUp(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RecoveryCodeVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RecoveryCodeVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|RecoveryCodeVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
