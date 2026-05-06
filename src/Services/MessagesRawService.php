<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\Message;
use BeeperDesktop\Messages\MessageDeleteParams;
use BeeperDesktop\Messages\MessageListParams;
use BeeperDesktop\Messages\MessageListParams\Direction;
use BeeperDesktop\Messages\MessageRetrieveParams;
use BeeperDesktop\Messages\MessageSearchParams;
use BeeperDesktop\Messages\MessageSearchParams\ChatType;
use BeeperDesktop\Messages\MessageSearchParams\MediaType;
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
     * Retrieve a message by final message ID, pendingMessageID, or Matrix event ID. Chat ID may be a Beeper chat ID or local chat ID.
     *
     * @param string $messageID message ID
     * @param array{chatID: string}|MessageRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Message>
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        array|MessageRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MessageRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $chatID = $parsed['chatID'];
        unset($parsed['chatID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/chats/%1$s/messages/%2$s', $chatID, $messageID],
            options: $options,
            convert: Message::class,
        );
    }

    /**
     * @api
     *
     * Edit the text content of an existing message. Messages with attachments cannot be edited.
     *
     * @param string $messageID path param: Message ID
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
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param array{
     *   cursor?: string, direction?: Direction|value-of<Direction>
     * }|MessageListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorNoLimit<Message>>
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
            page: CursorNoLimit::class,
        );
    }

    /**
     * @api
     *
     * Delete a message by final message ID. Pending message IDs are not accepted because messages cannot be deleted while sending.
     *
     * @param string $messageID path param: Message ID
     * @param array{
     *   chatID: string, forEveryone?: bool|null
     * }|MessageDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $messageID,
        array|MessageDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MessageDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $chatID = $parsed['chatID'];
        unset($parsed['chatID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/chats/%1$s/messages/%2$s', $chatID, $messageID],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Search messages across chats.
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
     *   sender?: string,
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
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
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
