<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login\Verification\RecoveryKey;

use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetConfirmParams;
use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetConfirmResponse;
use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetCreateParams;
use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKey\ResetRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop and Beeper Server.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ResetRawService implements ResetRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new recovery key when the user cannot use the existing one.
     *
     * @param array{existingRecoveryKey?: string}|ResetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResetNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ResetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ResetCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/verification/recovery-key/reset',
            body: (object) $parsed,
            options: $options,
            convert: ResetNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Confirm that the new recovery key should be used for this account.
     *
     * @param array{recoveryKey: string}|ResetConfirmParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResetConfirmResponse>
     *
     * @throws APIException
     */
    public function confirm(
        array|ResetConfirmParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ResetConfirmParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/verification/recovery-key/reset/confirm',
            body: (object) $parsed,
            options: $options,
            convert: ResetConfirmResponse::class,
        );
    }
}
