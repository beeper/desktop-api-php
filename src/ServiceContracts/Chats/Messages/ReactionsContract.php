<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Chats\Messages;

use BeeperDesktop\Chats\Messages\Reactions\ReactionAddResponse;
use BeeperDesktop\Chats\Messages\Reactions\ReactionDeleteResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ReactionsContract
{
    /**
     * @api
     *
     * @param string $reactionKey Reaction key to remove (emoji, shortcode, or custom emoji key)
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param string $messageID message ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $reactionKey,
        string $chatID,
        string $messageID,
        RequestOptions|array|null $requestOptions = null,
    ): ReactionDeleteResponse;

    /**
     * @api
     *
     * @param string $messageID path param: Message ID
     * @param string $chatID Path param: Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param string $reactionKey Body param: Reaction key to add (emoji, shortcode, or custom emoji key)
     * @param string $transactionID Body param: Optional transaction ID for deduplication and send tracking
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function add(
        string $messageID,
        string $chatID,
        string $reactionKey,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ReactionAddResponse;
}
