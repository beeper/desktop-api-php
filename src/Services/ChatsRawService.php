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
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatRetrieveParams;
use BeeperDesktop\Chats\ChatSearchParams;
use BeeperDesktop\Chats\ChatSearchParams\Inbox;
use BeeperDesktop\Chats\ChatSearchParams\Scope;
use BeeperDesktop\Chats\ChatStartParams;
use BeeperDesktop\Chats\ChatStartParams\User;
use BeeperDesktop\Chats\ChatStartResponse;
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
     * Create a direct or group chat from participant IDs.
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
     * Retrieve chat details including metadata, participants, and latest message
     *
     * @param string $chatID unique identifier of the chat
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
     * Archive or unarchive a chat. Set archived=true to move to archive, archived=false to move back to inbox
     *
     * @param string $chatID unique identifier of the chat
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
     * Resolve a user/contact and open a direct chat. Reuses an existing direct chat when one is found. Available in Beeper Desktop v4.2.799+.
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
            path: 'v1/chats.start',
            body: (object) $parsed,
            options: $options,
            convert: ChatStartResponse::class,
        );
    }
}
