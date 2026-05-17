<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\App\Verifications\VerificationAcceptResponse;
use BeeperDesktop\App\Verifications\VerificationCancelResponse;
use BeeperDesktop\App\Verifications\VerificationCreateParams\Purpose;
use BeeperDesktop\App\Verifications\VerificationGetResponse;
use BeeperDesktop\App\Verifications\VerificationListResponse;
use BeeperDesktop\App\Verifications\VerificationNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\VerificationsContract;
use BeeperDesktop\Services\App\Verifications\QrService;
use BeeperDesktop\Services\App\Verifications\SASService;

/**
 * Manage device verification transactions.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class VerificationsService implements VerificationsContract
{
    /**
     * @api
     */
    public VerificationsRawService $raw;

    /**
     * @api
     */
    public QrService $qr;

    /**
     * @api
     */
    public SASService $sas;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VerificationsRawService($client);
        $this->qr = new QrService($client);
        $this->sas = new SASService($client);
    }

    /**
     * @api
     *
     * Start verifying this device from another signed-in device.
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
    ): VerificationNewResponse {
        $params = Util::removeNulls(['purpose' => $purpose, 'userID' => $userID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the current state of a device verification transaction.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): VerificationGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($verificationID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List pending and active device verifications. Use this to recover state without a WebSocket connection.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): VerificationListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

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
