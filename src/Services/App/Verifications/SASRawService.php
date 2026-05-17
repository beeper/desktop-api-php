<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Verifications;

use BeeperDesktop\App\Verifications\SAS\SASConfirmResponse;
use BeeperDesktop\App\Verifications\SAS\SASStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Verifications\SASRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop and Beeper Server.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class SASRawService implements SASRawContract
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
     * @return BaseResponse<SASConfirmResponse>
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
            path: ['v1/app/setup/verifications/%1$s/sas/confirm', $verificationID],
            options: $requestOptions,
            convert: SASConfirmResponse::class,
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
     * @return BaseResponse<SASStartResponse>
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
            path: ['v1/app/setup/verifications/%1$s/sas/start', $verificationID],
            options: $requestOptions,
            convert: SASStartResponse::class,
        );
    }
}
