<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login\Verification;

use BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyParams;
use BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKeyRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop and Beeper Server.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RecoveryKeyRawService implements RecoveryKeyRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Unlock encrypted messages with the user recovery key.
     *
     * @param array{recoveryKey: string}|RecoveryKeyVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RecoveryKeyVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|RecoveryKeyVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RecoveryKeyVerifyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/verification/recovery-key',
            body: (object) $parsed,
            options: $options,
            convert: RecoveryKeyVerifyResponse::class,
        );
    }
}
