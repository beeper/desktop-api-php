<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatArchiveParams;
use BeeperDesktop\Chats\ChatCreateParams;
use BeeperDesktop\Chats\ChatListParams;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatRetrieveParams;
use BeeperDesktop\Chats\ChatSearchParams;
use BeeperDesktop\Chats\ChatStartParams;
use BeeperDesktop\Chats\ChatStartResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ChatsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ChatCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ChatCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $chatID unique identifier of the chat
     * @param array<string,mixed>|ChatRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ChatListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorNoLimit<ChatListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ChatListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $chatID unique identifier of the chat
     * @param array<string,mixed>|ChatArchiveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ChatSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorSearch<Chat>>
     *
     * @throws APIException
     */
    public function search(
        array|ChatSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ChatStartParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatStartResponse>
     *
     * @throws APIException
     */
    public function start(
        array|ChatStartParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
