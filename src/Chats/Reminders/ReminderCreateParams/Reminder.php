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
 *   remindAt: \DateTimeInterface, dismissOnIncomingMessage?: bool|null
 * }
 */
final class Reminder implements BaseModel
{
    /** @use SdkModel<ReminderShape> */
    use SdkModel;

    /**
     * Timestamp when the reminder should trigger.
     */
    #[Required]
    public \DateTimeInterface $remindAt;

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
     * Reminder::with(remindAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reminder)->withRemindAt(...)
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
        \DateTimeInterface $remindAt,
        ?bool $dismissOnIncomingMessage = null
    ): self {
        $self = new self;

        $self['remindAt'] = $remindAt;

        null !== $dismissOnIncomingMessage && $self['dismissOnIncomingMessage'] = $dismissOnIncomingMessage;

        return $self;
    }

    /**
     * Timestamp when the reminder should trigger.
     */
    public function withRemindAt(\DateTimeInterface $remindAt): self
    {
        $self = clone $this;
        $self['remindAt'] = $remindAt;

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
