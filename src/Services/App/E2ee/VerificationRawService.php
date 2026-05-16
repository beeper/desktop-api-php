<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee;

use BeeperDesktop\App\E2ee\Verification\VerificationAcceptResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationCancelParams;
use BeeperDesktop\App\E2ee\Verification\VerificationCancelResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationCreateParams;
use BeeperDesktop\App\E2ee\Verification\VerificationNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\VerificationRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class VerificationRawService implements VerificationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Start verifying this device from another signed-in device.
     *
     * @param array{userID?: string}|VerificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|VerificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VerificationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/e2ee/verification',
            body: (object) $parsed,
            options: $options,
            convert: VerificationNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Accept an incoming device verification request.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/app/e2ee/verification/%1$s/accept', $verificationID],
            options: $requestOptions,
            convert: VerificationAcceptResponse::class,
        );
    }

    /**
     * @api
     *
     * Cancel an active device verification request.
     *
     * @param string $verificationID verification ID
     * @param array{code?: string, reason?: string}|VerificationCancelParams $params
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
    ): BaseResponse {
        [$parsed, $options] = VerificationCancelParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/app/e2ee/verification/%1$s/cancel', $verificationID],
            body: (object) $parsed,
            options: $options,
            convert: VerificationCancelResponse::class,
        );
    }
}
