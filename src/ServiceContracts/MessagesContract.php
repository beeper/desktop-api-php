<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\Message;
use BeeperDesktop\Messages\MessageListParams\Direction;
use BeeperDesktop\Messages\MessageSearchParams\ChatType;
use BeeperDesktop\Messages\MessageSearchParams\MediaType;
use BeeperDesktop\Messages\MessageSendParams\Attachment;
use BeeperDesktop\Messages\MessageSendResponse;
use BeeperDesktop\Messages\MessageUpdateResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Messages\MessageSendParams\Attachment
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface MessagesContract
{
    /**
     * @api
     *
     * @param string $messageID message ID
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        string $chatID,
        RequestOptions|array|null $requestOptions = null,
    ): Message;

    /**
     * @api
     *
     * @param string $messageID path param: Message ID
     * @param string $chatID Path param: Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
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
    ): MessageUpdateResponse;

    /**
     * @api
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param string $cursor Opaque pagination cursor; do not inspect. Use together with 'direction'.
     * @param Direction|value-of<Direction> $direction Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorNoLimit<Message>
     *
     * @throws APIException
     */
    public function list(
        string $chatID,
        ?string $cursor = null,
        Direction|string|null $direction = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorNoLimit;

    /**
     * @api
     *
     * @param string $messageID path param: Message ID
     * @param string $chatID Path param: Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param bool|null $forEveryone query param: True to request deletion for everyone when the network supports it; false to delete only for the authenticated user when supported
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $messageID,
        string $chatID,
        ?bool $forEveryone = true,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
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
     * @param string $sender Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
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
        ?string $sender = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorSearch;

    /**
     * @api
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param Attachment|AttachmentShape $attachment Single attachment to send with the message
     * @param string $replyToMessageID Provide a message ID to send this as a reply to an existing message
     * @param string $text Draft text. Plain text and Markdown are converted to Matrix HTML with the same rules used by send and edit.
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
    ): MessageSendResponse;
}
