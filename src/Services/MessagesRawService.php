<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\CursorSortKey;
use BeeperDesktop\Message;
use BeeperDesktop\Messages\MessageListParams;
use BeeperDesktop\Messages\MessageListParams\Direction;
use BeeperDesktop\Messages\MessageSearchParams;
use BeeperDesktop\Messages\MessageSearchParams\ChatType;
use BeeperDesktop\Messages\MessageSearchParams\MediaType;
use BeeperDesktop\Messages\MessageSearchParams\Sender;
use BeeperDesktop\Messages\MessageSendParams;
use BeeperDesktop\Messages\MessageSendParams\Attachment;
use BeeperDesktop\Messages\MessageSendResponse;
use BeeperDesktop\Messages\MessageUpdateParams;
use BeeperDesktop\Messages\MessageUpdateResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\MessagesRawContract;

/**
 * Manage messages in chats.
 *
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Messages\MessageSendParams\Attachment
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class MessagesRawService implements MessagesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Edit the text content of an existing message. Messages with attachments cannot be edited.
     *
     * @param string $messageID Path param: ID of the message to edit
     * @param array{chatID: string, text: string}|MessageUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MessageUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $messageID,
        array|MessageUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MessageUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $chatID = $parsed['chatID'];
        unset($parsed['chatID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['v1/chats/%1$s/messages/%2$s', $chatID, $messageID],
            body: (object) array_diff_key($parsed, array_flip(['chatID'])),
            options: $options,
            convert: MessageUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * List all messages in a chat with cursor-based pagination. Sorted by timestamp.
     *
     * @param string $chatID unique identifier of the chat
     * @param array{
     *   cursor?: string, direction?: Direction|value-of<Direction>
     * }|MessageListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorSortKey<Message>>
     *
     * @throws APIException
     */
    public function list(
        string $chatID,
        array|MessageListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MessageListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/chats/%1$s/messages', $chatID],
            query: $parsed,
            options: $options,
            convert: Message::class,
            page: CursorSortKey::class,
        );
    }

    /**
     * @api
     *
     * Search messages across chats using Beeper's message index
     *
     * @param array{
     *   accountIDs?: list<string>,
     *   chatIDs?: list<string>,
     *   chatType?: ChatType|value-of<ChatType>,
     *   cursor?: string,
     *   dateAfter?: \DateTimeInterface,
     *   dateBefore?: \DateTimeInterface,
     *   direction?: MessageSearchParams\Direction|value-of<MessageSearchParams\Direction>,
     *   excludeLowPriority?: bool|null,
     *   includeMuted?: bool|null,
     *   limit?: int,
     *   mediaTypes?: list<MediaType|value-of<MediaType>>,
     *   query?: string,
     *   sender?: string|Sender|value-of<Sender>,
     * }|MessageSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorSearch<Message>>
     *
     * @throws APIException
     */
    public function search(
        array|MessageSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MessageSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/messages/search',
            query: $parsed,
            options: $options,
            convert: Message::class,
            page: CursorSearch::class,
        );
    }

    /**
     * @api
     *
     * Send a text message to a specific chat. Supports replying to existing messages. Returns a pending message ID.
     *
     * @param string $chatID unique identifier of the chat
     * @param array{
     *   attachment?: Attachment|AttachmentShape,
     *   replyToMessageID?: string,
     *   text?: string,
     * }|MessageSendParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MessageSendResponse>
     *
     * @throws APIException
     */
    public function send(
        string $chatID,
        array|MessageSendParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MessageSendParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/chats/%1$s/messages', $chatID],
            body: (object) $parsed,
            options: $options,
            convert: MessageSendResponse::class,
        );
    }
}
