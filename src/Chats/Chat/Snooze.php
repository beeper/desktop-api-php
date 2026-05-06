<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Current snooze state for this chat, or null when no snooze is set.
 *
 * @phpstan-type SnoozeShape = array{
 *   snoozeUntil?: \DateTimeInterface|null, userSnoozedAt?: \DateTimeInterface|null
 * }
 */
final class Snooze implements BaseModel
{
    /** @use SdkModel<SnoozeShape> */
    use SdkModel;

    /**
     * Timestamp when the snooze expires.
     */
    #[Optional]
    public ?\DateTimeInterface $snoozeUntil;

    /**
     * Timestamp when the user set the snooze.
     */
    #[Optional]
    public ?\DateTimeInterface $userSnoozedAt;

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
        ?\DateTimeInterface $snoozeUntil = null,
        ?\DateTimeInterface $userSnoozedAt = null,
    ): self {
        $self = new self;

        null !== $snoozeUntil && $self['snoozeUntil'] = $snoozeUntil;
        null !== $userSnoozedAt && $self['userSnoozedAt'] = $userSnoozedAt;

        return $self;
    }

    /**
     * Timestamp when the snooze expires.
     */
    public function withSnoozeUntil(\DateTimeInterface $snoozeUntil): self
    {
        $self = clone $this;
        $self['snoozeUntil'] = $snoozeUntil;

        return $self;
    }

    /**
     * Timestamp when the user set the snooze.
     */
    public function withUserSnoozedAt(\DateTimeInterface $userSnoozedAt): self
    {
        $self = clone $this;
        $self['userSnoozedAt'] = $userSnoozedAt;

        return $self;
    }
}
