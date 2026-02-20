<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Reminders;

use BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Set a reminder for a chat at a specific time.
 *
 * @see BeeperDesktop\Services\Chats\RemindersService::create()
 *
 * @phpstan-import-type ReminderShape from \BeeperDesktop\Chats\Reminders\ReminderCreateParams\Reminder
 *
 * @phpstan-type ReminderCreateParamsShape = array{
 *   reminder: Reminder|ReminderShape
 * }
 */
final class ReminderCreateParams implements BaseModel
{
    /** @use SdkModel<ReminderCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Reminder configuration.
     */
    #[Required]
    public Reminder $reminder;

    /**
     * `new ReminderCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReminderCreateParams::with(reminder: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReminderCreateParams)->withReminder(...)
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
     *
     * @param Reminder|ReminderShape $reminder
     */
    public static function with(Reminder|array $reminder): self
    {
        $self = new self;

        $self['reminder'] = $reminder;

        return $self;
    }

    /**
     * Reminder configuration.
     *
     * @param Reminder|ReminderShape $reminder
     */
    public function withReminder(Reminder|array $reminder): self
    {
        $self = clone $this;
        $self['reminder'] = $reminder;

        return $self;
    }
}
