<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Assets\AssetDownloadResponse;
use BeeperDesktop\Assets\AssetUploadBase64Response;
use BeeperDesktop\Assets\AssetUploadResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\FileParam;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\AssetsContract;

/**
 * Manage assets in Beeper Desktop, like message attachments.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AssetsService implements AssetsContract
{
    /**
     * @api
     */
    public AssetsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AssetsRawService($client);
    }

    /**
     * @api
     *
     * Download a Matrix asset using its mxc:// or localmxc:// URL to the device running Beeper Desktop and return the local file URL.
     *
     * @param string $url matrix content URL (mxc:// or localmxc://) for the asset to download
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): AssetDownloadResponse {
        $params = Util::removeNulls(['url' => $url]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->download(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stream a file given an mxc://, localmxc://, or file:// URL. Downloads first if not cached. Supports Range requests for seeking in large files.
     *
     * @param string $url Asset URL to serve. Accepts mxc://, localmxc://, or file:// URLs.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function serve(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['url' => $url]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->serve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Upload a file to a temporary location using multipart/form-data. Returns an uploadID that can be referenced when sending messages with attachments.
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
    ): AssetUploadResponse {
        $params = Util::removeNulls(
            ['file' => $file, 'fileName' => $fileName, 'mimeType' => $mimeType]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->upload(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Upload a file using a JSON body with base64-encoded content. Returns an uploadID that can be referenced when sending messages with attachments. Alternative to the multipart upload endpoint.
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
    ): AssetUploadBase64Response {
        $params = Util::removeNulls(
            ['content' => $content, 'fileName' => $fileName, 'mimeType' => $mimeType]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->uploadBase64(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
