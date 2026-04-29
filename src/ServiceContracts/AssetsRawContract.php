<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Assets\AssetDownloadParams;
use BeeperDesktop\Assets\AssetDownloadResponse;
use BeeperDesktop\Assets\AssetServeParams;
use BeeperDesktop\Assets\AssetUploadBase64Params;
use BeeperDesktop\Assets\AssetUploadBase64Response;
use BeeperDesktop\Assets\AssetUploadParams;
use BeeperDesktop\Assets\AssetUploadResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AssetsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AssetDownloadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetDownloadResponse>
     *
     * @throws APIException
     */
    public function download(
        array|AssetDownloadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetServeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function serve(
        array|AssetServeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        array|AssetUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetUploadBase64Params $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetUploadBase64Response>
     *
     * @throws APIException
     */
    public function uploadBase64(
        array|AssetUploadBase64Params $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
