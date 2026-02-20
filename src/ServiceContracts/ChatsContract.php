<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatCreateParams\Mode;
use BeeperDesktop\Chats\ChatCreateParams\Type;
use BeeperDesktop\Chats\ChatCreateParams\User;
use BeeperDesktop\Chats\ChatListParams\Direction;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatSearchParams\Inbox;
use BeeperDesktop\Chats\ChatSearchParams\Scope;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type UserShape from \BeeperDesktop\Chats\ChatCreateParams\User
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ChatsContract
{
    /**
     * @api
     *
     * @param string $accountID account to create or start the chat on
     * @param bool $allowInvite Whether invite-based DM creation is allowed when required by the platform. Used for mode='start'.
     * @param string $messageText optional first message content if the platform requires it to create the chat
     * @param Mode|value-of<Mode> $mode Operation mode. Defaults to 'create' when omitted.
     * @param list<string> $participantIDs Required when mode='create'. User IDs to include in the new chat.
     * @param string $title optional title for group chats when mode='create'; ignored for single chats on most platforms
     * @param Type|value-of<Type> $type Required when mode='create'. 'single' requires exactly one participantID; 'group' supports multiple participants and optional title.
     * @param User|UserShape $user Required when mode='start'. Merged user-like contact payload used to resolve the best identifier.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        bool $allowInvite = true,
        ?string $messageText = null,
        Mode|string|null $mode = null,
        ?array $participantIDs = null,
        ?string $title = null,
        Type|string|null $type = null,
        User|array|null $user = null,
        RequestOptions|array|null $requestOptions = null,
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
    ): Chat;

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
     * @param \BeeperDesktop\Chats\ChatSearchParams\Type|value-of<\BeeperDesktop\Chats\ChatSearchParams\Type> $type Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, or "any" to get all types
     * @param bool|null $unreadOnly Set to true to only retrieve chats that have unread messages
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorSearch<Chat>
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
        \BeeperDesktop\Chats\ChatSearchParams\Type|string $type = 'any',
        ?bool $unreadOnly = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorSearch;
}
