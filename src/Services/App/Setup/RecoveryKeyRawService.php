<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Setup;

use BeeperDesktop\App\Setup\RecoveryKey\RecoveryKeyVerifyParams;
use BeeperDesktop\App\Setup\RecoveryKey\RecoveryKeyVerifyResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Setup\RecoveryKeyRawContract;

/**
 * Manage recovery-key setup for encrypted messages.
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
