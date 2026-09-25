<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Chats\Messages;

use BeeperDesktop\Chats\Messages\Reactions\ReactionAddParams;
use BeeperDesktop\Chats\Messages\Reactions\ReactionAddResponse;
use BeeperDesktop\Chats\Messages\Reactions\ReactionDeleteParams;
use BeeperDesktop\Chats\Messages\Reactions\ReactionDeleteResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Chats\Messages\ReactionsRawContract;

/**
 * Manage message reactions.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ReactionsRawService implements ReactionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Remove the reaction added by the authenticated user from an existing message.
     *
     * @param string $reactionKey Reaction key to remove (emoji, shortcode, or custom emoji key)
     * @param array{chatID: string, messageID: string}|ReactionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReactionDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $reactionKey,
        array|ReactionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ReactionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $chatID = $parsed['chatID'];
        unset($parsed['chatID']);
        $messageID = $parsed['messageID'];
        unset($parsed['messageID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'v1/chats/%1$s/messages/%2$s/reactions/%3$s',
                $chatID,
                $messageID,
                $reactionKey,
            ],
            options: $options,
            convert: ReactionDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Add a reaction to an existing message.
     *
     * @param string $messageID path param: Message ID
     * @param array{
     *   chatID: string, reactionKey: string, transactionID?: string
     * }|ReactionAddParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReactionAddResponse>
     *
     * @throws APIException
     */
    public function add(
        string $messageID,
        array|ReactionAddParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ReactionAddParams::parseRequest(
            $params,
            $requestOptions,
        );
        $chatID = $parsed['chatID'];
        unset($parsed['chatID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/chats/%1$s/messages/%2$s/reactions', $chatID, $messageID],
            body: (object) array_diff_key($parsed, array_flip(['chatID'])),
            options: $options,
            convert: ReactionAddResponse::class,
        );
    }
}
