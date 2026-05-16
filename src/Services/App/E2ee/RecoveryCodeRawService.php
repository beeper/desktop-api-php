<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee;

use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeVerifyParams;
use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeVerifyResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\RecoveryCodeRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RecoveryCodeRawService implements RecoveryCodeRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Record that the user saved their recovery key.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RecoveryCodeMarkBackedUpResponse>
     *
     * @throws APIException
     */
    public function markBackedUp(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/e2ee/recovery-code/mark-backed-up',
            options: $requestOptions,
            convert: RecoveryCodeMarkBackedUpResponse::class,
        );
    }

    /**
     * @api
     *
     * Unlock encrypted messages with the user recovery key.
     *
     * @param array{recoveryCode: string}|RecoveryCodeVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RecoveryCodeVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|RecoveryCodeVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RecoveryCodeVerifyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/e2ee/recovery-code/verify',
            body: (object) $parsed,
            options: $options,
            convert: RecoveryCodeVerifyResponse::class,
        );
    }
}
