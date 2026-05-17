<?php

declare(strict_types=1);

namespace BeeperDesktop\Message;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Message\SendStatus\Status;

/**
 * Message send status for this message, when reported by the bridge.
 *
 * @phpstan-type SendStatusShape = array{
 *   status: Status|value-of<Status>,
 *   timestamp: \DateTimeInterface,
 *   deliveredToUsers?: list<string>|null,
 *   internalError?: string|null,
 *   message?: string|null,
 *   reason?: string|null,
 * }
 */
final class SendStatus implements BaseModel
{
    /** @use SdkModel<SendStatusShape> */
    use SdkModel;

    /**
     * Current status of the message send attempt.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Timestamp for the send status event.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * User IDs the message was delivered to, when reported by the network.
     *
     * @var list<string>|null $deliveredToUsers
     */
    #[Optional(list: 'string')]
    public ?array $deliveredToUsers;

    /**
     * Diagnostic error detail from the messaging network adapter. Do not show directly to users.
     */
    #[Optional]
    public ?string $internalError;

    /**
     * Human-readable send status or failure message.
     */
    #[Optional]
    public ?string $message;

    /**
     * Machine-readable failure reason. Present when the send status is a failure.
     */
    #[Optional]
    public ?string $reason;

    /**
     * `new SendStatus()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendStatus::with(status: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendStatus)->withStatus(...)->withTimestamp(...)
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
     * @param Status|value-of<Status> $status
     * @param list<string>|null $deliveredToUsers
     */
    public static function with(
        Status|string $status,
        \DateTimeInterface $timestamp,
        ?array $deliveredToUsers = null,
        ?string $internalError = null,
        ?string $message = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['status'] = $status;
        $self['timestamp'] = $timestamp;

        null !== $deliveredToUsers && $self['deliveredToUsers'] = $deliveredToUsers;
        null !== $internalError && $self['internalError'] = $internalError;
        null !== $message && $self['message'] = $message;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * Current status of the message send attempt.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Timestamp for the send status event.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * User IDs the message was delivered to, when reported by the network.
     *
     * @param list<string> $deliveredToUsers
     */
    public function withDeliveredToUsers(array $deliveredToUsers): self
    {
        $self = clone $this;
        $self['deliveredToUsers'] = $deliveredToUsers;

        return $self;
    }

    /**
     * Diagnostic error detail from the messaging network adapter. Do not show directly to users.
     */
    public function withInternalError(string $internalError): self
    {
        $self = clone $this;
        $self['internalError'] = $internalError;

        return $self;
    }

    /**
     * Human-readable send status or failure message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Machine-readable failure reason. Present when the send status is a failure.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
