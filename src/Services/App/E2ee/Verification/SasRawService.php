<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Sas\SaConfirmResponse;
use BeeperDesktop\App\E2ee\Verification\Sas\SaStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\Verification\SasRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class SasRawService implements SasRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Confirm that the emoji or number sequence matches on both devices.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SaConfirmResponse>
     *
     * @throws APIException
     */
    public function confirm(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/app/e2ee/verification/%1$s/sas/confirm', $verificationID],
            options: $requestOptions,
            convert: SaConfirmResponse::class,
        );
    }

    /**
     * @api
     *
     * Start emoji comparison for device verification.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SaStartResponse>
     *
     * @throws APIException
     */
    public function start(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/app/e2ee/verification/%1$s/sas/start', $verificationID],
            options: $requestOptions,
            convert: SaStartResponse::class,
        );
    }
}
