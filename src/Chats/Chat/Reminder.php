<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Current reminder for this chat, or null when no reminder is set.
 *
 * @phpstan-type ReminderShape = array{
 *   dismissOnIncomingMessage?: bool|null, remindAt?: \DateTimeInterface|null
 * }
 */
final class Reminder implements BaseModel
{
    /** @use SdkModel<ReminderShape> */
    use SdkModel;

    /**
     * Cancel reminder if someone messages in the chat.
     */
    #[Optional]
    public ?bool $dismissOnIncomingMessage;

    /**
     * Timestamp when the reminder should trigger.
     */
    #[Optional]
    public ?\DateTimeInterface $remindAt;

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
        ?bool $dismissOnIncomingMessage = null,
        ?\DateTimeInterface $remindAt = null
    ): self {
        $self = new self;

        null !== $dismissOnIncomingMessage && $self['dismissOnIncomingMessage'] = $dismissOnIncomingMessage;
        null !== $remindAt && $self['remindAt'] = $remindAt;

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

    /**
     * Timestamp when the reminder should trigger.
     */
    public function withRemindAt(\DateTimeInterface $remindAt): self
    {
        $self = clone $this;
        $self['remindAt'] = $remindAt;

        return $self;
    }
}
