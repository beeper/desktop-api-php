<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee;

use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeVerifyResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\RecoveryCodeContract;
use BeeperDesktop\Services\App\E2ee\RecoveryCode\ResetService;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RecoveryCodeService implements RecoveryCodeContract
{
    /**
     * @api
     */
    public RecoveryCodeRawService $raw;

    /**
     * @api
     */
    public ResetService $reset;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RecoveryCodeRawService($client);
        $this->reset = new ResetService($client);
    }

    /**
     * @api
     *
     * Record that the user saved their recovery key.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function markBackedUp(
        RequestOptions|array|null $requestOptions = null
    ): RecoveryCodeMarkBackedUpResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->markBackedUp(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Unlock encrypted messages with the user recovery key.
     *
     * @param string $recoveryCode recovery key saved by the user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $recoveryCode,
        RequestOptions|array|null $requestOptions = null
    ): RecoveryCodeVerifyResponse {
        $params = Util::removeNulls(['recoveryCode' => $recoveryCode]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->verify(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
