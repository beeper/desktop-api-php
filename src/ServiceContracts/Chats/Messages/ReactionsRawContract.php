<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Chats\Messages;

use BeeperDesktop\Chats\Messages\Reactions\ReactionAddParams;
use BeeperDesktop\Chats\Messages\Reactions\ReactionAddResponse;
use BeeperDesktop\Chats\Messages\Reactions\ReactionDeleteParams;
use BeeperDesktop\Chats\Messages\Reactions\ReactionDeleteResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ReactionsRawContract
{
    /**
     * @api
     *
     * @param string $messageID Path param: ID of the message to remove a reaction from
     * @param array<string,mixed>|ReactionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReactionDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $messageID,
        array|ReactionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $messageID Path param: ID of the message to add a reaction to
     * @param array<string,mixed>|ReactionAddParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReactionAddResponse>
     *
     * @throws APIException
     */
    public function add(
        string $messageID,
        array|ReactionAddParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
