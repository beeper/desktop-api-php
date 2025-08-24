<?php

declare(strict_types=1);

namespace BeeperDesktop\Reminders;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Clear an existing reminder from a chat.
 */
final class ReminderClearParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the chat to clear reminder from.
     */
    #[Api]
    public string $chatID;

    /**
     * `new ReminderClearParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReminderClearParams::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReminderClearParams)->withChatID(...)
     * ```
     */
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
    public static function with(string $chatID): self
    {
        $obj = new self;

        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * The identifier of the chat to clear reminder from.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }
}
