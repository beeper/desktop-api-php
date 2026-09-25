<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Setup\Verifications;

use BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse;
use BeeperDesktop\App\Setup\Verifications\QR\QRScanParams;
use BeeperDesktop\App\Setup\Verifications\QR\QRScanResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface QRRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QRScanParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<QRScanResponse>
     *
     * @throws APIException
     */
    public function scan(
        array|QRScanParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
