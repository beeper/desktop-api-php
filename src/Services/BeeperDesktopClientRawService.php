<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceFocusResponse;
use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse;
use BeeperDesktop\BeeperDesktopFocusParams;
use BeeperDesktop\BeeperDesktopSearchParams;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\BeeperDesktopClientRawContract;

/**
 * Top-level actions: focus Beeper Desktop, jump to a chat, or run unified search across chats and messages.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class BeeperDesktopClientRawService implements BeeperDesktopClientRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Focus Beeper Desktop and optionally open a specific chat, jump to a message, or pre-fill text and an image.
     *
     * @param array{
     *   chatID?: string,
     *   draftAttachmentPath?: string,
     *   draftText?: string,
     *   messageID?: string,
     * }|BeeperDesktopFocusParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BeeperDesktopClientServiceFocusResponse>
     *
     * @throws APIException
     */
    public function focus(
        array|BeeperDesktopFocusParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BeeperDesktopFocusParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/focus',
            body: (object) $parsed,
            options: $options,
            convert: BeeperDesktopClientServiceFocusResponse::class,
        );
    }

    /**
     * @api
     *
     * Return matching chats, participant matches in group chats, and the first page of message results in one call. Use the dedicated chat and message search endpoints for pagination.
     *
     * @param array{query: string}|BeeperDesktopSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BeeperDesktopClientServiceSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|BeeperDesktopSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BeeperDesktopSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/search',
            query: $parsed,
            options: $options,
            convert: BeeperDesktopClientServiceSearchResponse::class,
        );
    }
}
