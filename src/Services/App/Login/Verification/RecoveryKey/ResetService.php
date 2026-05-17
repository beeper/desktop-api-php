<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login\Verification\RecoveryKey;

use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetConfirmResponse;
use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKey\ResetContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop and Beeper Server.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ResetService implements ResetContract
{
    /**
     * @api
     */
    public ResetRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ResetRawService($client);
    }

    /**
     * @api
     *
     * Create a new recovery key when the user cannot use the existing one.
     *
     * @param string $existingRecoveryKey existing recovery key, if the user has it
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $existingRecoveryKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): ResetNewResponse {
        $params = Util::removeNulls(
            ['existingRecoveryKey' => $existingRecoveryKey]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Confirm that the new recovery key should be used for this account.
     *
     * @param string $recoveryKey new recovery key returned by the reset step
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirm(
        string $recoveryKey,
        RequestOptions|array|null $requestOptions = null
    ): ResetConfirmResponse {
        $params = Util::removeNulls(['recoveryKey' => $recoveryKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->confirm(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
