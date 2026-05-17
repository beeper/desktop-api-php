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
     * @param string $reactionKey Reaction key to remove (emoji, shortcode, or custom emoji key)
     * @param array<string,mixed>|ReactionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReactionDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $reactionKey,
        array|ReactionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $messageID path param: Message ID
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
