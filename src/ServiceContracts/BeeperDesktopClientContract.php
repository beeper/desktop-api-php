<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceFocusResponse;
use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface BeeperDesktopClientContract
{
    /**
     * @api
     *
     * @param string $chatID Optional Beeper chat ID (or local chat ID) to focus after opening the app. If omitted, only opens/focuses the app.
     * @param string $draftAttachmentPath optional draft attachment path to populate in the message input field
     * @param string $draftText optional draft text to populate in the message input field
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
    ): BeeperDesktopClientServiceFocusResponse;

    /**
     * @api
     *
     * @param string $query User-typed search text. Literal word matching (non-semantic).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        RequestOptions|array|null $requestOptions = null
    ): BeeperDesktopClientServiceSearchResponse;
}
