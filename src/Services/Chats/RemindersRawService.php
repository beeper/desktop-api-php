<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Chats;

use BeeperDesktop\Chats\Reminders\ReminderCreateParams;
use BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Chats\RemindersRawContract;

/**
 * Manage reminders for chats.
 *
 * @phpstan-import-type ReminderShape from \BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RemindersRawService implements RemindersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Set a reminder for a chat at a specific time
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param array{reminder: Reminder|ReminderShape}|ReminderCreateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ReminderCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/chats/%1$s/reminders', $chatID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Clear an existing reminder from a chat
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $chatID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/chats/%1$s/reminders', $chatID],
            options: $requestOptions,
            convert: null,
        );
    }
}
