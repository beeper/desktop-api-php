<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee\RecoveryCode;

use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetConfirmResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\RecoveryCode\ResetContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
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
     * @param string $recoveryCode existing recovery key, if the user has it
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $recoveryCode = null,
        RequestOptions|array|null $requestOptions = null,
    ): ResetNewResponse {
        $params = Util::removeNulls(['recoveryCode' => $recoveryCode]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Confirm that the new recovery key should be used for this account.
     *
     * @param string $recoveryCode new recovery key returned by the reset step
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirm(
        string $recoveryCode,
        RequestOptions|array|null $requestOptions = null
    ): ResetConfirmResponse {
        $params = Util::removeNulls(['recoveryCode' => $recoveryCode]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->confirm(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
