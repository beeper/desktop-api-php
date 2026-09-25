<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Setup\Verifications;

use BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse;
use BeeperDesktop\App\Setup\Verifications\QR\QRScanResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface QRContract
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
    ): QRConfirmScannedResponse;

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
    ): QRScanResponse;
}
