<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatArchiveParams;
use BeeperDesktop\Chats\ChatCreateParams;
use BeeperDesktop\Chats\ChatCreateParams\Type;
use BeeperDesktop\Chats\ChatListParams;
use BeeperDesktop\Chats\ChatListParams\Direction;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatMarkReadParams;
use BeeperDesktop\Chats\ChatMarkUnreadParams;
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatRetrieveParams;
use BeeperDesktop\Chats\ChatSearchParams;
use BeeperDesktop\Chats\ChatSearchParams\Inbox;
use BeeperDesktop\Chats\ChatSearchParams\Scope;
use BeeperDesktop\Chats\ChatStartParams;
use BeeperDesktop\Chats\ChatStartParams\User;
use BeeperDesktop\Chats\ChatStartResponse;
use BeeperDesktop\Chats\ChatUpdateParams;
use BeeperDesktop\Chats\ChatUpdateParams\Draft;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\ChatsRawContract;

/**
 * Manage chats.
 *
 * @phpstan-import-type DraftShape from \BeeperDesktop\Chats\ChatUpdateParams\Draft
 * @phpstan-import-type UserShape from \BeeperDesktop\Chats\ChatStartParams\User
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ChatsRawService implements ChatsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a direct or group chat from participant IDs. Returns the created chat.
     *
     * @param array{
     *   accountID: string,
     *   participantIDs: list<string>,
     *   type: Type|value-of<Type>,
     *   messageText?: string,
     *   title?: string,
     * }|ChatCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ChatCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/chats',
            body: (object) $parsed,
            options: $options,
            convert: ChatNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve chat details, including metadata, participants, and the latest message.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param array{maxParticipantCount?: int|null}|ChatRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Chat>
     *
     * @throws APIException
     */
    public function retrieve(
        string $chatID,
        array|ChatRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/chats/%1$s', $chatID],
            query: $parsed,
            options: $options,
            convert: Chat::class,
        );
    }

    /**
     * @api
     *
     * Update supported chat fields. Non-empty drafts are accepted only when the current draft is empty. Send draft=null to clear the draft before setting new draft text or attachments.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param array{
     *   description?: string|null,
     *   draft?: Draft|DraftShape|null,
     *   imgURL?: string|null,
     *   isArchived?: bool,
     *   isLowPriority?: bool,
     *   isMuted?: bool,
     *   isPinned?: bool,
     *   messageExpirySeconds?: int|null,
     *   title?: string|null,
     * }|ChatUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Chat>
     *
     * @throws APIException
     */
    public function update(
        string $chatID,
        array|ChatUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['v1/chats/%1$s', $chatID],
            body: (object) $parsed,
            options: $options,
            convert: Chat::class,
        );
    }

    /**
     * @api
     *
     * List all chats sorted by last activity (most recent first). Combines all accounts into a single paginated list.
     *
     * @param array{
     *   accountIDs?: list<string>,
     *   cursor?: string,
     *   direction?: Direction|value-of<Direction>,
     * }|ChatListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorNoLimit<ChatListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ChatListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/chats',
            query: $parsed,
            options: $options,
            convert: ChatListResponse::class,
            page: CursorNoLimit::class,
        );
    }

    /**
     * @api
     *
     * Archive or unarchive a chat. Set archived=true to move it to Archive, or archived=false to move it back to the inbox.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param array{archived?: bool}|ChatArchiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $chatID,
        array|ChatArchiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatArchiveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/chats/%1$s/archive', $chatID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Mark a chat as read, optionally through a specific message ID.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param array{messageID?: string}|ChatMarkReadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Chat>
     *
     * @throws APIException
     */
    public function markRead(
        string $chatID,
        array|ChatMarkReadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatMarkReadParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/chats/%1$s/read', $chatID],
            body: (object) $parsed,
            options: $options,
            convert: Chat::class,
        );
    }

    /**
     * @api
     *
     * Mark a chat as unread, optionally from a specific message ID.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param array{messageID?: string}|ChatMarkUnreadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Chat>
     *
     * @throws APIException
     */
    public function markUnread(
        string $chatID,
        array|ChatMarkUnreadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatMarkUnreadParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/chats/%1$s/unread', $chatID],
            body: (object) $parsed,
            options: $options,
            convert: Chat::class,
        );
    }

    /**
     * @api
     *
     * Send a notification despite the recipient focus state when the network supports it. Currently intended for iMessage on macOS; unsupported networks return an error.
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Chat>
     *
     * @throws APIException
     */
    public function notifyAnyway(
        string $chatID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/chats/%1$s/notify-anyway', $chatID],
            options: $requestOptions,
            convert: Chat::class,
        );
    }

    /**
     * @api
     *
     * Search chats by title, network, or participant names.
     *
     * @param array{
     *   accountIDs?: list<string>,
     *   cursor?: string,
     *   direction?: ChatSearchParams\Direction|value-of<ChatSearchParams\Direction>,
     *   inbox?: Inbox|value-of<Inbox>,
     *   includeMuted?: bool|null,
     *   lastActivityAfter?: \DateTimeInterface,
     *   lastActivityBefore?: \DateTimeInterface,
     *   limit?: int,
     *   query?: string,
     *   scope?: Scope|value-of<Scope>,
     *   type?: ChatSearchParams\Type|value-of<ChatSearchParams\Type>,
     *   unreadOnly?: bool|null,
     * }|ChatSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorSearch<Chat>>
     *
     * @throws APIException
     */
    public function search(
        array|ChatSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/chats/search',
            query: $parsed,
            options: $options,
            convert: Chat::class,
            page: CursorSearch::class,
        );
    }

    /**
     * @api
     *
     * Resolve a user/contact and open a direct chat. Reuses and returns an existing direct chat when one is found. Available in Beeper v4.2.808+.
     *
     * @param array{
     *   accountID: string,
     *   user: User|UserShape,
     *   allowInvite?: bool,
     *   messageText?: string,
     * }|ChatStartParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatStartResponse>
     *
     * @throws APIException
     */
    public function start(
        array|ChatStartParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatStartParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/chats/start',
            body: (object) $parsed,
            options: $options,
            convert: ChatStartResponse::class,
        );
    }
}
