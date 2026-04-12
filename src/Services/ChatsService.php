<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0;
use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember1;
use BeeperDesktop\Chats\ChatListParams\Direction;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatSearchParams\Inbox;
use BeeperDesktop\Chats\ChatSearchParams\Scope;
use BeeperDesktop\Chats\ChatSearchParams\Type;
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
 * @phpstan-import-type ParamsShape from \BeeperDesktop\Chats\ChatCreateParams\Params
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
     * Create a single/group chat (mode='create') or start a direct chat from merged user data (mode='start').
     *
     * @param ParamsShape $params
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        UnionMember0|array|UnionMember1|null $params = null,
        RequestOptions|array|null $requestOptions = null,
    ): ChatNewResponse {
        $params1 = Util::removeNulls(['params' => $params]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params1, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve chat details including metadata, participants, and latest message
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
     * Archive or unarchive a chat. Set archived=true to move to archive, archived=false to move back to inbox
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
    ): mixed {
        $params = Util::removeNulls(['archived' => $archived]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search chats by title/network or participants using Beeper Desktop's renderer algorithm.
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
        Type|string $type = 'any',
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
}
