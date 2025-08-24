<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Contracts\RemindersContract;
use BeeperDesktop\Core\Conversion;
use BeeperDesktop\Reminders\ReminderClearParams;
use BeeperDesktop\Reminders\ReminderSetParams;
use BeeperDesktop\Reminders\ReminderSetParams\Reminder;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\Shared\BaseResponse;

/**
 * Set and clear reminders for chats.
 */
final class RemindersService implements RemindersContract
{
    public function __construct(private Client $client) {}

    /**
     * Clear an existing reminder from a chat.
     *
     * @param string $chatID The identifier of the chat to clear reminder from
     */
    public function clear(
        $chatID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        $args = ['chatID' => $chatID];
        [$parsed, $options] = ReminderClearParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v0/clear-chat-reminder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BaseResponse::class, value: $resp);
    }

    /**
     * Set a reminder for a chat at a specific time.
     *
     * @param string $chatID The identifier of the chat to set reminder for
     * @param Reminder $reminder Reminder configuration
     */
    public function set(
        $chatID,
        $reminder,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        $args = ['chatID' => $chatID, 'reminder' => $reminder];
        [$parsed, $options] = ReminderSetParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v0/set-chat-reminder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BaseResponse::class, value: $resp);
    }
}
