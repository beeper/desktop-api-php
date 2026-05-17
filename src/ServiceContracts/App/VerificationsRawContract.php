<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App;

use BeeperDesktop\App\Verifications\VerificationAcceptResponse;
use BeeperDesktop\App\Verifications\VerificationCancelParams;
use BeeperDesktop\App\Verifications\VerificationCancelResponse;
use BeeperDesktop\App\Verifications\VerificationCreateParams;
use BeeperDesktop\App\Verifications\VerificationGetResponse;
use BeeperDesktop\App\Verifications\VerificationListResponse;
use BeeperDesktop\App\Verifications\VerificationNewResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface VerificationsRawContract
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
     * @return BaseResponse<VerificationGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
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
