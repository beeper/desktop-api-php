<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee;

use BeeperDesktop\App\E2ee\Verification\VerificationAcceptResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationCancelResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationNewResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface VerificationContract
{
    /**
     * @api
     *
     * @param string $userID User ID to verify. Defaults to the signed-in user.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $userID = null,
        RequestOptions|array|null $requestOptions = null
    ): VerificationNewResponse;

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
