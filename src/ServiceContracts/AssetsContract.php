<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Assets\AssetDownloadResponse;
use BeeperDesktop\Assets\AssetUploadBase64Response;
use BeeperDesktop\Assets\AssetUploadResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\FileParam;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AssetsContract
{
    /**
     * @api
     *
     * @param string $url matrix content URL (mxc:// or localmxc://) for the asset to download
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): AssetDownloadResponse;

    /**
     * @api
     *
     * @param string $url Asset URL to serve. Accepts mxc://, localmxc://, or file:// URLs.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function serve(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string|FileParam $file the file to upload (max 500 MB)
     * @param string $fileName Original filename. Defaults to the uploaded file name if omitted
     * @param string $mimeType MIME type. Auto-detected from magic bytes if omitted
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function upload(
        string|FileParam $file,
        ?string $fileName = null,
        ?string $mimeType = null,
        RequestOptions|array|null $requestOptions = null,
    ): AssetUploadResponse;

    /**
     * @api
     *
     * @param string $content Base64-encoded file content (max ~500MB decoded)
     * @param string $fileName Original filename. Generated if omitted
     * @param string $mimeType MIME type. Auto-detected from magic bytes if omitted
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function uploadBase64(
        string $content,
        ?string $fileName = null,
        ?string $mimeType = null,
        RequestOptions|array|null $requestOptions = null,
    ): AssetUploadBase64Response;
}
