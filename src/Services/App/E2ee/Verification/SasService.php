<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Sas\SaConfirmResponse;
use BeeperDesktop\App\E2ee\Verification\Sas\SaStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\Verification\SasContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class SasService implements SasContract
{
    /**
     * @api
     */
    public SasRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SasRawService($client);
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
    ): SaConfirmResponse {
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
    ): SaStartResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->start($verificationID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
