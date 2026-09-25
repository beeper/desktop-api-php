<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Setup\Verifications;

use BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse;
use BeeperDesktop\App\Setup\Verifications\QR\QRScanParams;
use BeeperDesktop\App\Setup\Verifications\QR\QRScanResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Setup\Verifications\QRRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop and Beeper Server.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class QRRawService implements QRRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Confirm that another device scanned this device QR code.
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<QRConfirmScannedResponse>
     *
     * @throws APIException
     */
    public function confirmScanned(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'v1/app/setup/verifications/%1$s/qr/confirm-scanned', $verificationID,
            ],
            options: $requestOptions,
            convert: QRConfirmScannedResponse::class,
        );
    }

    /**
     * @api
     *
     * Submit the QR code scanned from another signed-in device.
     *
     * @param array{data: string}|QRScanParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<QRScanResponse>
     *
     * @throws APIException
     */
    public function scan(
        array|QRScanParams $params,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = QRScanParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/verifications/qr/scan',
            body: (object) $parsed,
            options: $options,
            convert: QRScanResponse::class,
        );
    }
}
