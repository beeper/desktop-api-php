<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\CursorSortKey;
use BeeperDesktop\Message;
use BeeperDesktop\Messages\MessageListParams\Direction;
use BeeperDesktop\Messages\MessageSearchParams\ChatType;
use BeeperDesktop\Messages\MessageSearchParams\MediaType;
use BeeperDesktop\Messages\MessageSearchParams\Sender;
use BeeperDesktop\Messages\MessageSendParams\Attachment;
use BeeperDesktop\Messages\MessageSendResponse;
use BeeperDesktop\Messages\MessageUpdateResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\MessagesContract;

/**
 * Manage messages in chats.
 *
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Messages\MessageSendParams\Attachment
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class MessagesService implements MessagesContract
{
    /**
     * @api
     */
    public MessagesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MessagesRawService($client);
    }

    /**
     * @api
     *
     * Edit the text content of an existing message. Messages with attachments cannot be edited.
     *
     * @param string $messageID Path param: ID of the message to edit
     * @param string $chatID path param: Unique identifier of the chat
     * @param string $text Body param: New text content for the message
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $messageID,
        string $chatID,
        string $text,
        RequestOptions|array|null $requestOptions = null,
    ): MessageUpdateResponse {
        $params = Util::removeNulls(['chatID' => $chatID, 'text' => $text]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($messageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all messages in a chat with cursor-based pagination. Sorted by timestamp.
     *
     * @param string $chatID unique identifier of the chat
     * @param string $cursor Opaque pagination cursor; do not inspect. Use together with 'direction'.
     * @param Direction|value-of<Direction> $direction Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorSortKey<Message>
     *
     * @throws APIException
     */
    public function list(
        string $chatID,
        ?string $cursor = null,
        Direction|string|null $direction = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorSortKey {
        $params = Util::removeNulls(
            ['cursor' => $cursor, 'direction' => $direction]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search messages across chats using Beeper's message index
     *
     * @param list<string> $accountIDs limit search to specific account IDs
     * @param list<string> $chatIDs limit search to specific chat IDs
     * @param ChatType|value-of<ChatType> $chatType filter by chat type: 'group' for group chats, 'single' for 1:1 chats
     * @param string $cursor Opaque pagination cursor; do not inspect. Use together with 'direction'.
     * @param \DateTimeInterface $dateAfter Only include messages with timestamp strictly after this ISO 8601 datetime (e.g., '2024-07-01T00:00:00Z' or '2024-07-01T00:00:00+02:00').
     * @param \DateTimeInterface $dateBefore Only include messages with timestamp strictly before this ISO 8601 datetime (e.g., '2024-07-31T23:59:59Z' or '2024-07-31T23:59:59+02:00').
     * @param \BeeperDesktop\Messages\MessageSearchParams\Direction|value-of<\BeeperDesktop\Messages\MessageSearchParams\Direction> $direction Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     * @param bool|null $excludeLowPriority Exclude messages marked Low Priority by the user. Default: true. Set to false to include all.
     * @param bool|null $includeMuted Include messages in chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     * @param int $limit maximum number of messages to return
     * @param list<MediaType|value-of<MediaType>> $mediaTypes Filter messages by media types. Use ['any'] for any media type, or specify exact types like ['video', 'image']. Omit for no media filtering.
     * @param string $query Literal word search (non-semantic). Finds messages containing these EXACT words in any order. Use single words users actually type, not concepts or phrases. Example: use "dinner" not "dinner plans", use "sick" not "health issues". If omitted, returns results filtered only by other parameters.
     * @param string|Sender|value-of<Sender> $sender Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorSearch<Message>
     *
     * @throws APIException
     */
    public function search(
        ?array $accountIDs = null,
        ?array $chatIDs = null,
        ChatType|string|null $chatType = null,
        ?string $cursor = null,
        ?\DateTimeInterface $dateAfter = null,
        ?\DateTimeInterface $dateBefore = null,
        \BeeperDesktop\Messages\MessageSearchParams\Direction|string|null $direction = null,
        ?bool $excludeLowPriority = true,
        ?bool $includeMuted = true,
        int $limit = 20,
        ?array $mediaTypes = null,
        ?string $query = null,
        Sender|string|null $sender = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorSearch {
        $params = Util::removeNulls(
            [
                'accountIDs' => $accountIDs,
                'chatIDs' => $chatIDs,
                'chatType' => $chatType,
                'cursor' => $cursor,
                'dateAfter' => $dateAfter,
                'dateBefore' => $dateBefore,
                'direction' => $direction,
                'excludeLowPriority' => $excludeLowPriority,
                'includeMuted' => $includeMuted,
                'limit' => $limit,
                'mediaTypes' => $mediaTypes,
                'query' => $query,
                'sender' => $sender,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send a text message to a specific chat. Supports replying to existing messages. Returns a pending message ID.
     *
     * @param string $chatID unique identifier of the chat
     * @param Attachment|AttachmentShape $attachment Single attachment to send with the message
     * @param string $replyToMessageID Provide a message ID to send this as a reply to an existing message
     * @param string $text Text content of the message you want to send. You may use markdown.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function send(
        string $chatID,
        Attachment|array|null $attachment = null,
        ?string $replyToMessageID = null,
        ?string $text = null,
        RequestOptions|array|null $requestOptions = null,
    ): MessageSendResponse {
        $params = Util::removeNulls(
            [
                'attachment' => $attachment,
                'replyToMessageID' => $replyToMessageID,
                'text' => $text,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->send($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
