<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Chats;

use BeeperDesktop\Chats\Reminders\ReminderCreateParams;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RemindersRawContract
{
    /**
     * @api
     *
     * @param string $chatID unique identifier of the chat
     * @param array<string,mixed>|ReminderCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $chatID,
        array|ReminderCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $chatID unique identifier of the chat
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $chatID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
