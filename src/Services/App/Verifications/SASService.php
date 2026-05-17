<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Verifications;

use BeeperDesktop\App\Verifications\SAS\SASConfirmResponse;
use BeeperDesktop\App\Verifications\SAS\SASStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Verifications\SASContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop and Beeper Server.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class SASService implements SASContract
{
    /**
     * @api
     */
    public SASRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SASRawService($client);
    }

    /**
     * @api
     *
     * Confirm that the emoji or number sequence matches on both devices.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirm(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): SASConfirmResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->confirm($verificationID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Start emoji comparison for device verification.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): SASStartResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->start($verificationID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
