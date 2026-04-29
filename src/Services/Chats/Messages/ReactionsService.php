<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Chats\Messages;

use BeeperDesktop\Chats\Messages\Reactions\ReactionAddResponse;
use BeeperDesktop\Chats\Messages\Reactions\ReactionDeleteResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Chats\Messages\ReactionsContract;

/**
 * Manage message reactions.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ReactionsService implements ReactionsContract
{
    /**
     * @api
     */
    public ReactionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ReactionsRawService($client);
    }

    /**
     * @api
     *
     * Remove the reaction added by the authenticated user from an existing message.
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
    ): ReactionDeleteResponse {
        $params = Util::removeNulls(
            ['chatID' => $chatID, 'reactionKey' => $reactionKey]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($messageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Add a reaction to an existing message.
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
    ): ReactionAddResponse {
        $params = Util::removeNulls(
            [
                'chatID' => $chatID,
                'reactionKey' => $reactionKey,
                'transactionID' => $transactionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->add($messageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
