<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Chats\ChatCreateParams\Chat;
use BeeperDesktop\Chats\ChatListParams\Direction;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatSearchParams\Inbox;
use BeeperDesktop\Chats\ChatSearchParams\Scope;
use BeeperDesktop\Chats\ChatSearchParams\Type;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type ChatShape from \BeeperDesktop\Chats\ChatCreateParams\Chat
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ChatsContract
{
    /**
     * @api
     *
     * @param Chat|ChatShape $chat
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Chat|array $chat,
        RequestOptions|array|null $requestOptions = null
    ): ChatNewResponse;

    /**
     * @api
     *
     * @param string $chatID unique identifier of the chat
     * @param int|null $maxParticipantCount Maximum number of participants to return. Use -1 for all; otherwise 0–500. Defaults to all (-1).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $chatID,
        ?int $maxParticipantCount = -1,
        RequestOptions|array|null $requestOptions = null,
    ): \BeeperDesktop\Chats\Chat;

    /**
     * @api
     *
     * @param list<string> $accountIDs Limit to specific account IDs. If omitted, fetches from all accounts.
     * @param string $cursor Opaque pagination cursor; do not inspect. Use together with 'direction'.
     * @param Direction|value-of<Direction> $direction Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorNoLimit<ChatListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?array $accountIDs = null,
        ?string $cursor = null,
        Direction|string|null $direction = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorNoLimit;

    /**
     * @api
     *
     * @param string $chatID unique identifier of the chat
     * @param bool $archived True to archive, false to unarchive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $chatID,
        bool $archived = true,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param list<string> $accountIDs Provide an array of account IDs to filter chats from specific messaging accounts only
     * @param string $cursor Opaque pagination cursor; do not inspect. Use together with 'direction'.
     * @param \BeeperDesktop\Chats\ChatSearchParams\Direction|value-of<\BeeperDesktop\Chats\ChatSearchParams\Direction> $direction Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     * @param Inbox|value-of<Inbox> $inbox Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
     * @param bool|null $includeMuted Include chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     * @param \DateTimeInterface $lastActivityAfter Provide an ISO datetime string to only retrieve chats with last activity after this time
     * @param \DateTimeInterface $lastActivityBefore Provide an ISO datetime string to only retrieve chats with last activity before this time
     * @param int $limit Set the maximum number of chats to retrieve. Valid range: 1-200, default is 50
     * @param string $query Literal token search (non-semantic). Use single words users type (e.g., "dinner"). When multiple words provided, ALL must match. Case-insensitive.
     * @param Scope|value-of<Scope> $scope search scope: 'titles' matches title + network; 'participants' matches participant names
     * @param Type|value-of<Type> $type Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, or "any" to get all types
     * @param bool|null $unreadOnly Set to true to only retrieve chats that have unread messages
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorSearch<\BeeperDesktop\Chats\Chat>
     *
     * @throws APIException
     */
    public function search(
        ?array $accountIDs = null,
        ?string $cursor = null,
        \BeeperDesktop\Chats\ChatSearchParams\Direction|string|null $direction = null,
        Inbox|string|null $inbox = null,
        ?bool $includeMuted = true,
        ?\DateTimeInterface $lastActivityAfter = null,
        ?\DateTimeInterface $lastActivityBefore = null,
        int $limit = 50,
        ?string $query = null,
        Scope|string $scope = 'titles',
        Type|string $type = 'any',
        ?bool $unreadOnly = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorSearch;
}
