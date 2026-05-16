<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Qr\QrConfirmScannedResponse;
use BeeperDesktop\App\E2ee\Verification\Qr\QrScanParams;
use BeeperDesktop\App\E2ee\Verification\Qr\QrScanResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\E2ee\Verification\QrRawContract;

/**
 * First-party sign-in and encrypted messaging setup for Beeper Desktop.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class QrRawService implements QrRawContract
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
     * @return BaseResponse<QrConfirmScannedResponse>
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
                'v1/app/e2ee/verification/%1$s/qr/confirm-scanned', $verificationID,
            ],
            options: $requestOptions,
            convert: QrConfirmScannedResponse::class,
        );
    }

    /**
     * @api
     *
     * Submit the QR code scanned from another signed-in device.
     *
     * @param array{data: string}|QrScanParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<QrScanResponse>
     *
     * @throws APIException
     */
    public function scan(
        array|QrScanParams $params,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = QrScanParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/e2ee/verification/qr/scan',
            body: (object) $parsed,
            options: $options,
            convert: QrScanResponse::class,
        );
    }
}
