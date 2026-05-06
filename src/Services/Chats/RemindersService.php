<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Chats;

use BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Chats\RemindersContract;

/**
 * Manage reminders for chats.
 *
 * @phpstan-import-type ReminderShape from \BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RemindersService implements RemindersContract
{
    /**
     * @api
     */
    public RemindersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RemindersRawService($client);
    }

    /**
     * @api
     *
     * Set a reminder for a chat at a specific time
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param Reminder|ReminderShape $reminder Reminder configuration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $chatID,
        Reminder|array $reminder,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['reminder' => $reminder]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($chatID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Clear an existing reminder from a chat
     *
     * @param string $chatID Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $chatID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($chatID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
