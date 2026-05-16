<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Qr\QrConfirmScannedResponse;
use BeeperDesktop\App\E2ee\Verification\Qr\QrScanResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface QrContract
{
    /**
     * @api
     *
     * @param string $verificationID verification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirmScanned(
        string $verificationID,
        RequestOptions|array|null $requestOptions = null
    ): QrConfirmScannedResponse;

    /**
     * @api
     *
     * @param string $data QR code payload scanned from the other device
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function scan(
        string $data,
        RequestOptions|array|null $requestOptions = null
    ): QrScanResponse;
}
