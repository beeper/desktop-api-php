<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Qr\QrConfirmScannedResponse;
use BeeperDesktop\App\E2ee\Verification\Qr\QrScanResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\Verification\QrContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class QrService implements QrContract
{
    /**
     * @api
     */
    public QrRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new QrRawService($client);
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
    ): QrConfirmScannedResponse {
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
    ): QrScanResponse {
        $params = Util::removeNulls(['data' => $data]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->scan(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
