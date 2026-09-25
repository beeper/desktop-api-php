<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSessions\Steps;

use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams\Source;
use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Submit input for the current step of a bridge login session.
 *
 * @see BeeperDesktop\Services\Bridges\LoginSessions\StepsService::submit()
 *
 * @phpstan-type StepSubmitParamsShape = array{
 *   bridgeID: string,
 *   loginSessionID: string,
 *   type: Type|value-of<Type>,
 *   fields?: array<string,string>|null,
 *   lastURL?: string|null,
 *   source?: null|Source|value-of<Source>,
 * }
 */
final class StepSubmitParams implements BaseModel
{
    /** @use SdkModel<StepSubmitParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bridge ID.
     */
    #[Required]
    public string $bridgeID;

    /**
     * Temporary bridge login session ID.
     */
    #[Required]
    public string $loginSessionID;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Field values keyed by the field IDs from the current step.
     *
     * @var array<string,string>|null $fields
     */
    #[Optional(map: 'string')]
    public ?array $fields;

    /**
     * Last browser URL reached during a cookies step, if available.
     */
    #[Optional]
    public ?string $lastURL;

    /**
     * How the step was completed. Omit unless the client needs to distinguish an embedded webview or browser extension.
     *
     * @var value-of<Source>|null $source
     */
    #[Optional(enum: Source::class)]
    public ?string $source;

    /**
     * `new StepSubmitParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StepSubmitParams::with(bridgeID: ..., loginSessionID: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StepSubmitParams)
     *   ->withBridgeID(...)
     *   ->withLoginSessionID(...)
     *   ->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param array<string,string>|null $fields
     * @param Source|value-of<Source>|null $source
     */
    public static function with(
        string $bridgeID,
        string $loginSessionID,
        Type|string $type,
        ?array $fields = null,
        ?string $lastURL = null,
        Source|string|null $source = null,
    ): self {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['loginSessionID'] = $loginSessionID;
        $self['type'] = $type;

        null !== $fields && $self['fields'] = $fields;
        null !== $lastURL && $self['lastURL'] = $lastURL;
        null !== $source && $self['source'] = $source;

        return $self;
    }

    /**
     * Bridge ID.
     */
    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    /**
     * Temporary bridge login session ID.
     */
    public function withLoginSessionID(string $loginSessionID): self
    {
        $self = clone $this;
        $self['loginSessionID'] = $loginSessionID;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Field values keyed by the field IDs from the current step.
     *
     * @param array<string,string> $fields
     */
    public function withFields(array $fields): self
    {
        $self = clone $this;
        $self['fields'] = $fields;

        return $self;
    }

    /**
     * Last browser URL reached during a cookies step, if available.
     */
    public function withLastURL(string $lastURL): self
    {
        $self = clone $this;
        $self['lastURL'] = $lastURL;

        return $self;
    }

    /**
     * How the step was completed. Omit unless the client needs to distinguish an embedded webview or browser extension.
     *
     * @param Source|value-of<Source> $source
     */
    public function withSource(Source|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
