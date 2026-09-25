<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Setup\Verifications;

use BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse;
use BeeperDesktop\App\Setup\Verifications\QR\QRScanResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Setup\Verifications\QRContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop and Beeper Server.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class QRService implements QRContract
{
    /**
     * @api
     */
    public QRRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new QRRawService($client);
    }

    /**
     * @api
     *
     * Confirm that another device scanned this device QR code.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirmScanned(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): QRConfirmScannedResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->confirmScanned($verificationID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Submit the QR code scanned from another signed-in device.
     *
     * @param string $data QR code payload scanned from the other device
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function scan(
        string $data,
        RequestOptions|array|null $requestOptions = null
    ): QRScanResponse {
        $params = Util::removeNulls(['data' => $data]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->scan(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
