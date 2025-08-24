<?php

declare(strict_types=1);

namespace BeeperDesktop\Reminders\SetReminderRequest;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Reminder configuration.
 */
final class Reminder implements BaseModel
{
    use SdkModel;

    /**
     * Unix timestamp in milliseconds when reminder should trigger.
     */
    #[Api]
    public float $remindAtMs;

    /**
     * Cancel reminder if someone messages in the chat.
     */
    #[Api(optional: true)]
    public ?bool $dismissOnIncomingMessage;

    /**
     * `new Reminder()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Reminder::with(remindAtMs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reminder)->withRemindAtMs(...)
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
    public static function with(
        float $remindAtMs,
        ?bool $dismissOnIncomingMessage = null
    ): self {
        $obj = new self;

        $obj->remindAtMs = $remindAtMs;

        null !== $dismissOnIncomingMessage && $obj->dismissOnIncomingMessage = $dismissOnIncomingMessage;

        return $obj;
    }

    /**
     * Unix timestamp in milliseconds when reminder should trigger.
     */
    public function withRemindAtMs(float $remindAtMs): self
    {
        $obj = clone $this;
        $obj->remindAtMs = $remindAtMs;

        return $obj;
    }

    /**
     * Cancel reminder if someone messages in the chat.
     */
    public function withDismissOnIncomingMessage(
        bool $dismissOnIncomingMessage
    ): self {
        $obj = clone $this;
        $obj->dismissOnIncomingMessage = $dismissOnIncomingMessage;

        return $obj;
    }
}
