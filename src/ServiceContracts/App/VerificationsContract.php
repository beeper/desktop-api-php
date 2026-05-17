<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App;

use BeeperDesktop\App\Verifications\VerificationAcceptResponse;
use BeeperDesktop\App\Verifications\VerificationCancelResponse;
use BeeperDesktop\App\Verifications\VerificationCreateParams\Purpose;
use BeeperDesktop\App\Verifications\VerificationGetResponse;
use BeeperDesktop\App\Verifications\VerificationListResponse;
use BeeperDesktop\App\Verifications\VerificationNewResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface VerificationsContract
{
    /**
     * @api
     *
     * @param Purpose|value-of<Purpose> $purpose why this verification is being started
     * @param string $userID Beeper user ID to verify. Defaults to the signed-in user.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Purpose|string $purpose = 'device',
        ?string $userID = null,
        RequestOptions|array|null $requestOptions = null,
    ): VerificationNewResponse;

    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): VerificationGetResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): VerificationListResponse;

    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function accept(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): VerificationAcceptResponse;

    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param string $code optional cancellation code
     * @param string $reason optional user-facing cancellation reason
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $verificationID,
        ?string $code = null,
        ?string $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): VerificationCancelResponse;
}
