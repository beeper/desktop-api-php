<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login\State\StateEvent;

/**
 * The connection status of an individual login.
 *
 * @phpstan-type StateShape = array{
 *   stateEvent: StateEvent|value-of<StateEvent>,
 *   timestamp: float,
 *   error?: string|null,
 *   info?: mixed,
 *   message?: string|null,
 *   reason?: string|null,
 * }
 */
final class State implements BaseModel
{
    /** @use SdkModel<StateShape> */
    use SdkModel;

    /**
     * The current state of this login.
     *
     * @var value-of<StateEvent> $stateEvent
     */
    #[Required('state_event', enum: StateEvent::class)]
    public string $stateEvent;

    /**
     * The time when the state was last updated.
     */
    #[Required]
    public float $timestamp;

    /**
     * An error code defined by the network connector.
     */
    #[Optional]
    public ?string $error;

    /**
     * Additional arbitrary info provided by the network connector.
     */
    #[Optional]
    public mixed $info;

    /**
     * A human-readable error message defined by the network connector.
     */
    #[Optional]
    public ?string $message;

    /**
     * A reason code for non-error states that aren't exactly successes either.
     */
    #[Optional]
    public ?string $reason;

    /**
     * `new State()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * State::with(stateEvent: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new State)->withStateEvent(...)->withTimestamp(...)
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
     * @param StateEvent|value-of<StateEvent> $stateEvent
     */
    public static function with(
        StateEvent|string $stateEvent,
        float $timestamp,
        ?string $error = null,
        mixed $info = null,
        ?string $message = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['stateEvent'] = $stateEvent;
        $self['timestamp'] = $timestamp;

        null !== $error && $self['error'] = $error;
        null !== $info && $self['info'] = $info;
        null !== $message && $self['message'] = $message;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * The current state of this login.
     *
     * @param StateEvent|value-of<StateEvent> $stateEvent
     */
    public function withStateEvent(StateEvent|string $stateEvent): self
    {
        $self = clone $this;
        $self['stateEvent'] = $stateEvent;

        return $self;
    }

    /**
     * The time when the state was last updated.
     */
    public function withTimestamp(float $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * An error code defined by the network connector.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Additional arbitrary info provided by the network connector.
     */
    public function withInfo(mixed $info): self
    {
        $self = clone $this;
        $self['info'] = $info;

        return $self;
    }

    /**
     * A human-readable error message defined by the network connector.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * A reason code for non-error states that aren't exactly successes either.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
