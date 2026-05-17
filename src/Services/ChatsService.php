<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatCreateParams\Type;
use BeeperDesktop\Chats\ChatListParams\Direction;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatSearchParams\Inbox;
use BeeperDesktop\Chats\ChatSearchParams\Scope;
use BeeperDesktop\Chats\ChatStartParams\User;
use BeeperDesktop\Chats\ChatStartResponse;
use BeeperDesktop\Chats\ChatUpdateParams\Draft;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\ChatsContract;
use BeeperDesktop\Services\Chats\MessagesService;
use BeeperDesktop\Services\Chats\RemindersService;

/**
 * Manage chats.
 *
 * @phpstan-import-type DraftShape from \BeeperDesktop\Chats\ChatUpdateParams\Draft
 * @phpstan-import-type UserShape from \BeeperDesktop\Chats\ChatStartParams\User
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ChatsService implements ChatsContract
{
    /**
     * @api
     */
    public ChatsRawService $raw;

    /**
     * @api
     */
    public RemindersService $reminders;

    /**
     * @api
     */
    public MessagesService $messages;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ChatsRawService($client);
        $this->reminders = new RemindersService($client);
        $this->messages = new MessagesService($client);
    }

    /**
     * @api
     *
     * Create a direct or group chat from participant IDs. Returns the created chat.
     *
     * @param string $accountID account to create or start the chat on
     * @param list<string> $participantIDs user IDs to include in the new chat
     * @param Type|value-of<Type> $type 'single' requires exactly one participantID; 'group' supports multiple participants and optional title
     * @param string $messageText optional first message content if the platform requires it to create the chat
     * @param string $title optional title for group chats; ignored for single chats on most networks
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        array $participantIDs,
        Type|string $type,
        ?string $messageText = null,
        ?string $title = null,
        RequestOptions|array|null $requestOptions = null,
    ): ChatNewResponse {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'participantIDs' => $participantIDs,
                'type' => $type,
                'messageText' => $messageText,
                'title' => $title,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve chat details, including metadata, participants, and the latest message.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param int|null $maxParticipantCount Maximum number of participants to return. Use -1 for all; otherwise 0-500. Defaults to 100. List and search endpoints return up to 20 participants per chat.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $chatID,
        ?int $maxParticipantCount = 100,
        RequestOptions|array|null $requestOptions = null,
    ): Chat {
        $params = Util::removeNulls(
            ['maxParticipantCount' => $maxParticipantCount]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update supported chat fields. Non-empty drafts are accepted only when the current draft is empty. Send draft=null to clear the draft before setting new draft text or attachments.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param string|null $description Group chat description/topic. Support depends on the chat account and chat permissions.
     * @param Draft|DraftShape|null $draft Draft object to set or clear. Non-empty drafts are only accepted when the current draft is empty. Send draft=null to clear text and attachments together before setting a new draft.
     * @param string|null $imgURL Local filesystem path to a group chat avatar image. Support depends on the chat account and chat permissions.
     * @param bool $isArchived archive or unarchive the chat
     * @param bool $isLowPriority mark or unmark the chat as low priority when supported by the account
     * @param bool $isMuted mute or unmute the chat
     * @param bool $isPinned pin or unpin the chat when supported by the account
     * @param int|null $messageExpirySeconds disappearing-message timer in seconds, or null to clear when supported
     * @param string|null $title Custom chat title. Support depends on the chat account and chat permissions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $chatID,
        ?string $description = null,
        Draft|array|null $draft = null,
        ?string $imgURL = null,
        ?bool $isArchived = null,
        ?bool $isLowPriority = null,
        ?bool $isMuted = null,
        ?bool $isPinned = null,
        ?int $messageExpirySeconds = null,
        ?string $title = null,
        RequestOptions|array|null $requestOptions = null,
    ): Chat {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'draft' => $draft,
                'imgURL' => $imgURL,
                'isArchived' => $isArchived,
                'isLowPriority' => $isLowPriority,
                'isMuted' => $isMuted,
                'isPinned' => $isPinned,
                'messageExpirySeconds' => $messageExpirySeconds,
                'title' => $title,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all chats sorted by last activity (most recent first). Combines all accounts into a single paginated list.
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
    ): CursorNoLimit {
        $params = Util::removeNulls(
            [
                'accountIDs' => $accountIDs,
                'cursor' => $cursor,
                'direction' => $direction,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive or unarchive a chat. Set archived=true to move it to Archive, or archived=false to move it back to the inbox.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param bool $archived True to archive, false to unarchive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $chatID,
        bool $archived = true,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['archived' => $archived]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Mark a chat as read, optionally through a specific message ID.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param string $messageID optional message ID to mark read through
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function markRead(
        string $chatID,
        ?string $messageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Chat {
        $params = Util::removeNulls(['messageID' => $messageID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->markRead($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Mark a chat as unread, optionally from a specific message ID.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param string $messageID optional message ID to mark unread from
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function markUnread(
        string $chatID,
        ?string $messageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Chat {
        $params = Util::removeNulls(['messageID' => $messageID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->markUnread($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send a notification despite the recipient focus state when the network supports it. Currently intended for iMessage on macOS; unsupported networks return an error.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function notifyAnyway(
        string $chatID,
        RequestOptions|array|null $requestOptions = null
    ): Chat {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->notifyAnyway($chatID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search chats by title, network, or participant names.
     *
     * @param list<string> $accountIDs limit results to specific chat accounts
     * @param string $cursor Opaque pagination cursor; do not inspect. Use together with 'direction'.
     * @param \BeeperDesktop\Chats\ChatSearchParams\Direction|value-of<\BeeperDesktop\Chats\ChatSearchParams\Direction> $direction Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     * @param Inbox|value-of<Inbox> $inbox Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
     * @param bool|null $includeMuted Include chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     * @param \DateTimeInterface $lastActivityAfter only include chats with last activity after this ISO 8601 datetime
     * @param \DateTimeInterface $lastActivityBefore only include chats with last activity before this ISO 8601 datetime
     * @param int $limit Set the maximum number of chats to retrieve. Valid range: 1-200, default is 50
     * @param string $query Literal chat search. Use words the user typed, such as "dinner". When multiple words are provided, all must match. Case-insensitive.
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
    ): CursorSearch {
        $params = Util::removeNulls(
            [
                'accountIDs' => $accountIDs,
                'cursor' => $cursor,
                'direction' => $direction,
                'inbox' => $inbox,
                'includeMuted' => $includeMuted,
                'lastActivityAfter' => $lastActivityAfter,
                'lastActivityBefore' => $lastActivityBefore,
                'limit' => $limit,
                'query' => $query,
                'scope' => $scope,
                'type' => $type,
                'unreadOnly' => $unreadOnly,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Resolve a user/contact and open a direct chat. Reuses and returns an existing direct chat when one is found. Available in Beeper v4.2.808+.
     *
     * @param string $accountID account to create or start the chat on
     * @param User|UserShape $user contact-like user payload used to resolve the best identifier
     * @param bool $allowInvite whether invite-based DM creation is allowed when required by the platform
     * @param string $messageText optional first message content if the platform requires it to create the chat
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        string $accountID,
        User|array $user,
        bool $allowInvite = true,
        ?string $messageText = null,
        RequestOptions|array|null $requestOptions = null,
    ): ChatStartResponse {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'user' => $user,
                'allowInvite' => $allowInvite,
                'messageText' => $messageText,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->start(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
