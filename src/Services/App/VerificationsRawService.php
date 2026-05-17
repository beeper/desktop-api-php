<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\App\Verifications\VerificationAcceptResponse;
use BeeperDesktop\App\Verifications\VerificationCancelParams;
use BeeperDesktop\App\Verifications\VerificationCancelResponse;
use BeeperDesktop\App\Verifications\VerificationCreateParams;
use BeeperDesktop\App\Verifications\VerificationCreateParams\Purpose;
use BeeperDesktop\App\Verifications\VerificationGetResponse;
use BeeperDesktop\App\Verifications\VerificationListResponse;
use BeeperDesktop\App\Verifications\VerificationNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\VerificationsRawContract;

/**
 * Manage device verification transactions.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class VerificationsRawService implements VerificationsRawContract
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
     * @param array{
     *   purpose?: Purpose|value-of<Purpose>, userID?: string
     * }|VerificationCreateParams $params
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
            path: 'v1/app/setup/verifications',
            body: (object) $parsed,
            options: $options,
            convert: VerificationNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Get the current state of a device verification transaction.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/app/setup/verifications/%1$s', $verificationID],
            options: $requestOptions,
            convert: VerificationGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List pending and active device verifications. Use this to recover state without a WebSocket connection.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VerificationListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/app/setup/verifications',
            options: $requestOptions,
            convert: VerificationListResponse::class,
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
            path: ['v1/app/setup/verifications/%1$s/accept', $verificationID],
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
            path: ['v1/app/setup/verifications/%1$s/cancel', $verificationID],
            body: (object) $parsed,
            options: $options,
            convert: VerificationCancelResponse::class,
        );
    }
}
