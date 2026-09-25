<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceFocusResponse;
use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\BeeperDesktopClientContract;

/**
 * Top-level actions: focus Beeper Desktop, jump to a chat, or run unified search across chats and messages.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class BeeperDesktopClientService implements BeeperDesktopClientContract
{
    /**
     * @api
     */
    public BeeperDesktopClientRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BeeperDesktopClientRawService($client);
    }

    /**
     * @api
     *
     * Focus Beeper Desktop and optionally open a specific chat, jump to a message, or pre-fill text and an image.
     *
     * @param string $chatID Optional Beeper chat ID (or local chat ID) to focus after opening the app. If omitted, only opens/focuses the app.
     * @param string $draftAttachmentPath optional local image path to populate in the message input field
     * @param string $draftText optional plain text to populate in the message input field
     * @param string $messageID Optional message ID. Jumps to that message in the chat when opening.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function focus(
        ?string $chatID = null,
        ?string $draftAttachmentPath = null,
        ?string $draftText = null,
        ?string $messageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BeeperDesktopClientServiceFocusResponse {
        $params = Util::removeNulls(
            [
                'chatID' => $chatID,
                'draftAttachmentPath' => $draftAttachmentPath,
                'draftText' => $draftText,
                'messageID' => $messageID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->focus(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Return matching chats, participant matches in group chats, and the first page of message results in one call. Use the dedicated chat and message search endpoints for pagination.
     *
     * @param string $query User-typed search text. Uses literal word matching.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        RequestOptions|array|null $requestOptions = null
    ): BeeperDesktopClientServiceSearchResponse {
        $params = Util::removeNulls(['query' => $query]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
