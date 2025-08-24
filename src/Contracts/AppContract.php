<?php

declare(strict_types=1);

namespace BeeperDesktop\Contracts;

use BeeperDesktop\RequestOptions;
use BeeperDesktop\Shared\BaseResponse;

interface AppContract
{
    /**
     * @param string $chatID Optional Beeper chat ID to focus after bringing the app to foreground. If omitted, only foregrounds the app. Required if messageSortKey is present. No-op in headless environments.
     * @param string $messageSortKey Optional message sort key. Jumps to that message in the chat when foregrounding.
     */
    public function focus(
        $chatID = null,
        $messageSortKey = null,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
