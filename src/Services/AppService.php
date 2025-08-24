<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\App\AppFocusParams;
use BeeperDesktop\Client;
use BeeperDesktop\Contracts\AppContract;
use BeeperDesktop\Core\Conversion;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\Shared\BaseResponse;

/**
 * Control the Beeper Desktop application.
 */
final class AppService implements AppContract
{
    public function __construct(private Client $client) {}

    /**
     * Bring Beeper Desktop to the foreground on this device. Optionally focuses a specific chat if chatID is provided.
     * - When to use: open Beeper, or jump to a specific chat.
     * - Constraints: requires Beeper Desktop running locally; no-op in headless environments.
     * - Idempotent: safe to call repeatedly. Returns an error if chatID is not found.
     * Returns: success.
     *
     * @param string $chatID Optional Beeper chat ID to focus after bringing the app to foreground. If omitted, only foregrounds the app. Required if messageSortKey is present. No-op in headless environments.
     * @param string $messageSortKey Optional message sort key. Jumps to that message in the chat when foregrounding.
     */
    public function focus(
        $chatID = null,
        $messageSortKey = null,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        $args = ['chatID' => $chatID, 'messageSortKey' => $messageSortKey];
        $args = Util::array_filter_null($args, ['chatID', 'messageSortKey']);
        [$parsed, $options] = AppFocusParams::parseRequest($args, $requestOptions);
        $resp = $this->client->request(
            method: 'post',
            path: 'v0/focus-app',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BaseResponse::class, value: $resp);
    }
}
