<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Assets\AssetDownloadParams;
use BeeperDesktop\Assets\AssetDownloadResponse;
use BeeperDesktop\Assets\AssetServeParams;
use BeeperDesktop\Assets\AssetUploadBase64Params;
use BeeperDesktop\Assets\AssetUploadBase64Response;
use BeeperDesktop\Assets\AssetUploadParams;
use BeeperDesktop\Assets\AssetUploadResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\FileParam;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\AssetsRawContract;

/**
 * Manage assets in Beeper Desktop, like message attachments.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AssetsRawService implements AssetsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Download a Matrix asset using its mxc:// or localmxc:// URL to the device running Beeper Desktop and return the local file URL.
     *
     * @param array{url: string}|AssetDownloadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetDownloadResponse>
     *
     * @throws APIException
     */
    public function download(
        array|AssetDownloadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetDownloadParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/assets/download',
            body: (object) $parsed,
            options: $options,
            convert: AssetDownloadResponse::class,
        );
    }

    /**
     * @api
     *
     * Stream a file given an mxc://, localmxc://, or file:// URL. Downloads first if not cached. Supports Range requests for seeking in large files.
     *
     * @param array{url: string}|AssetServeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function serve(
        array|AssetServeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetServeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/assets/serve',
            query: $parsed,
            headers: ['Accept' => 'application/octet-stream'],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * Upload a file to a temporary location using multipart/form-data. Returns an uploadID that can be referenced when sending messages with attachments.
     *
     * @param array{
     *   file: string|FileParam, fileName?: string, mimeType?: string
     * }|AssetUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        array|AssetUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetUploadParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/assets/upload',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: AssetUploadResponse::class,
        );
    }

    /**
     * @api
     *
     * Upload a file using a JSON body with base64-encoded content. Returns an uploadID that can be referenced when sending messages with attachments. Alternative to the multipart upload endpoint.
     *
     * @param array{
     *   content: string, fileName?: string, mimeType?: string
     * }|AssetUploadBase64Params $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetUploadBase64Response>
     *
     * @throws APIException
     */
    public function uploadBase64(
        array|AssetUploadBase64Params $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetUploadBase64Params::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/assets/upload/base64',
            body: (object) $parsed,
            options: $options,
            convert: AssetUploadBase64Response::class,
        );
    }
}
