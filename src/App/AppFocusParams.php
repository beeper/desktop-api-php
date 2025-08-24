<?php

declare(strict_types=1);

namespace BeeperDesktop\App;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Bring Beeper Desktop to the foreground on this device. Optionally focuses a specific chat if chatID is provided.
 * - When to use: open Beeper, or jump to a specific chat.
 * - Constraints: requires Beeper Desktop running locally; no-op in headless environments.
 * - Idempotent: safe to call repeatedly. Returns an error if chatID is not found.
 * Returns: success.
 */
final class AppFocusParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * Optional Beeper chat ID to focus after bringing the app to foreground. If omitted, only foregrounds the app. Required if messageSortKey is present. No-op in headless environments.
     */
    #[Api(optional: true)]
    public ?string $chatID;

    /**
     * Optional message sort key. Jumps to that message in the chat when foregrounding.
     */
    #[Api(optional: true)]
    public ?string $messageSortKey;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $chatID = null,
        ?string $messageSortKey = null
    ): self {
        $obj = new self;

        null !== $chatID && $obj->chatID = $chatID;
        null !== $messageSortKey && $obj->messageSortKey = $messageSortKey;

        return $obj;
    }

    /**
     * Optional Beeper chat ID to focus after bringing the app to foreground. If omitted, only foregrounds the app. Required if messageSortKey is present. No-op in headless environments.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Optional message sort key. Jumps to that message in the chat when foregrounding.
     */
    public function withMessageSortKey(string $messageSortKey): self
    {
        $obj = clone $this;
        $obj->messageSortKey = $messageSortKey;

        return $obj;
    }
}
