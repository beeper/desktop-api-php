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
    ): ReactionDeleteResponse {
        $params = Util::removeNulls(
            ['chatID' => $chatID, 'messageID' => $messageID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($reactionKey, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Add a reaction to an existing message.
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
