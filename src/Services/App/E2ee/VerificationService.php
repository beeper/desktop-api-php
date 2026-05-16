<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee;

use BeeperDesktop\App\E2ee\Verification\VerificationAcceptResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationCancelResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\VerificationContract;
use BeeperDesktop\Services\App\E2ee\Verification\QrService;
use BeeperDesktop\Services\App\E2ee\Verification\SasService;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class VerificationService implements VerificationContract
{
    /**
     * @api
     */
    public VerificationRawService $raw;

    /**
     * @api
     */
    public QrService $qr;

    /**
     * @api
     */
    public SasService $sas;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VerificationRawService($client);
        $this->qr = new QrService($client);
        $this->sas = new SasService($client);
    }

    /**
     * @api
     *
     * Start verifying this device from another signed-in device.
     *
     * @param string $userID User ID to verify. Defaults to the signed-in user.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $userID = null,
        RequestOptions|array|null $requestOptions = null
    ): VerificationNewResponse {
        $params = Util::removeNulls(['userID' => $userID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Accept an incoming device verification request.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function accept(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): VerificationAcceptResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->accept($verificationID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel an active device verification request.
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
    ): VerificationCancelResponse {
        $params = Util::removeNulls(['code' => $code, 'reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($verificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
