<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Chats;

use BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type ReminderShape from \BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RemindersContract
{
    /**
     * @api
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param Reminder|ReminderShape $reminder Reminder configuration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $chatID,
        Reminder|array $reminder,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this installation when available.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $chatID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
