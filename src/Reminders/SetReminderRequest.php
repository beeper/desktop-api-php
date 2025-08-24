<?php

declare(strict_types=1);

namespace BeeperDesktop\Reminders;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Reminders\SetReminderRequest\Reminder;

final class SetReminderRequest implements BaseModel
{
    use SdkModel;

    /**
     * The identifier of the chat to set reminder for.
     */
    #[Api]
    public string $chatID;

    /**
     * Reminder configuration.
     */
    #[Api]
    public Reminder $reminder;

    /**
     * `new SetReminderRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SetReminderRequest::with(chatID: ..., reminder: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SetReminderRequest)->withChatID(...)->withReminder(...)
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
    public static function with(string $chatID, Reminder $reminder): self
    {
        $obj = new self;

        $obj->chatID = $chatID;
        $obj->reminder = $reminder;

        return $obj;
    }

    /**
     * The identifier of the chat to set reminder for.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Reminder configuration.
     */
    public function withReminder(Reminder $reminder): self
    {
        $obj = clone $this;
        $obj->reminder = $reminder;

        return $obj;
    }
}
