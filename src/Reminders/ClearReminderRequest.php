<?php

declare(strict_types=1);

namespace BeeperDesktop\Reminders;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class ClearReminderRequest implements BaseModel
{
    use SdkModel;

    /**
     * The identifier of the chat to clear reminder from.
     */
    #[Api]
    public string $chatID;

    /**
     * `new ClearReminderRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ClearReminderRequest::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ClearReminderRequest)->withChatID(...)
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
