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
     * @param string $messageID Path param: ID of the message to remove a reaction from
     * @param string $chatID path param: Unique identifier of the chat
     * @param string $reactionKey Query param: Reaction key to remove
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $messageID,
        string $chatID,
        string $reactionKey,
        RequestOptions|array|null $requestOptions = null,
    ): ReactionDeleteResponse;

    /**
     * @api
     *
     * @param string $messageID Path param: ID of the message to add a reaction to
     * @param string $chatID path param: Unique identifier of the chat
     * @param string $reactionKey Body param: Reaction key to add (emoji, shortcode, or custom emoji key)
     * @param string $transactionID Body param: Optional transaction ID for deduplication and local echo tracking
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
