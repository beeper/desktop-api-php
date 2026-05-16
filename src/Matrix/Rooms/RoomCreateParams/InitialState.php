<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\RoomCreateParams;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type InitialStateShape = array{
 *   content: mixed, type: string, stateKey?: string|null
 * }
 */
final class InitialState implements BaseModel
{
    /** @use SdkModel<InitialStateShape> */
    use SdkModel;

    /**
     * The content of the event.
     */
    #[Required]
    public mixed $content;

    /**
     * The type of event to send.
     */
    #[Required]
    public string $type;

    /**
     * The state_key of the state event. Defaults to an empty string.
     */
    #[Optional('state_key')]
    public ?string $stateKey;

    /**
     * `new InitialState()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InitialState::with(content: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InitialState)->withContent(...)->withType(...)
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
        mixed $content,
        string $type,
        ?string $stateKey = null
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['type'] = $type;

        null !== $stateKey && $self['stateKey'] = $stateKey;

        return $self;
    }

    /**
     * The content of the event.
     */
    public function withContent(mixed $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * The type of event to send.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The state_key of the state event. Defaults to an empty string.
     */
    public function withStateKey(string $stateKey): self
    {
        $self = clone $this;
        $self['stateKey'] = $stateKey;

        return $self;
    }
}
