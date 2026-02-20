<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Reminders\ReminderCreateParams;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Reminder configuration.
 *
 * @phpstan-type ReminderShape = array{
 *   remindAtMs: float, dismissOnIncomingMessage?: bool|null
 * }
 */
final class Reminder implements BaseModel
{
    /** @use SdkModel<ReminderShape> */
    use SdkModel;

    /**
     * Unix timestamp in milliseconds when reminder should trigger.
     */
    #[Required]
    public float $remindAtMs;

    /**
     * Cancel reminder if someone messages in the chat.
     */
    #[Optional]
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
        $this->initialize();
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
        $self = new self;

        $self['remindAtMs'] = $remindAtMs;

        null !== $dismissOnIncomingMessage && $self['dismissOnIncomingMessage'] = $dismissOnIncomingMessage;

        return $self;
    }

    /**
     * Unix timestamp in milliseconds when reminder should trigger.
     */
    public function withRemindAtMs(float $remindAtMs): self
    {
        $self = clone $this;
        $self['remindAtMs'] = $remindAtMs;

        return $self;
    }

    /**
     * Cancel reminder if someone messages in the chat.
     */
    public function withDismissOnIncomingMessage(
        bool $dismissOnIncomingMessage
    ): self {
        $self = clone $this;
        $self['dismissOnIncomingMessage'] = $dismissOnIncomingMessage;

        return $self;
    }
}
