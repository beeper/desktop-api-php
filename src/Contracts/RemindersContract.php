<?php

declare(strict_types=1);

namespace BeeperDesktop\Contracts;

use BeeperDesktop\Reminders\ReminderSetParams\Reminder;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\Shared\BaseResponse;

interface RemindersContract
{
    /**
     * @param string $chatID The identifier of the chat to clear reminder from
     */
    public function clear(
        $chatID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @param string $chatID The identifier of the chat to set reminder for
     * @param Reminder $reminder Reminder configuration
     */
    public function set(
        $chatID,
        $reminder,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
