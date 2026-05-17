<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App\Verifications;

use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse;
use BeeperDesktop\App\Verifications\Qr\QrScanParams;
use BeeperDesktop\App\Verifications\Qr\QrScanResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface QrRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QrScanParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<QrScanResponse>
     *
     * @throws APIException
     */
    public function scan(
        array|QrScanParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
