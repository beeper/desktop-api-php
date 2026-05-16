<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee;

use BeeperDesktop\App\E2ee\Verification\VerificationAcceptResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationCancelParams;
use BeeperDesktop\App\E2ee\Verification\VerificationCancelResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationCreateParams;
use BeeperDesktop\App\E2ee\Verification\VerificationNewResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface VerificationRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|VerificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|VerificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationAcceptResponse>
     *
     * @throws APIException
     */
    public function accept(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param array<string,mixed>|VerificationCancelParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationCancelResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $verificationID,
        array|VerificationCancelParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
