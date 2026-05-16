<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember0\DisplayAndWait;

/**
 * Display and wait login step.
 *
 * @phpstan-import-type DisplayAndWaitShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember0\DisplayAndWait
 *
 * @phpstan-type UnionMember0Shape = array{
 *   displayAndWait: DisplayAndWait|DisplayAndWaitShape,
 *   type: 'display_and_wait',
 *   instructions?: string|null,
 *   loginID?: string|null,
 *   stepID?: string|null,
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    /** @var 'display_and_wait' $type */
    #[Required]
    public string $type = 'display_and_wait';

    /**
     * Parameters for the display and wait login step.
     */
    #[Required('display_and_wait')]
    public DisplayAndWait $displayAndWait;

    /**
     * Human-readable instructions for completing this login step.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * An identifier for the current login process. Must be passed to execute more steps of the login.
     */
    #[Optional('login_id')]
    public ?string $loginID;

    /**
     * An unique ID identifying this step. This can be used to implement special behavior in clients.
     */
    #[Optional('step_id')]
    public ?string $stepID;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(displayAndWait: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)->withDisplayAndWait(...)
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
     * @param DisplayAndWait|DisplayAndWaitShape $displayAndWait
     */
    public static function with(
        DisplayAndWait|array $displayAndWait,
        ?string $instructions = null,
        ?string $loginID = null,
        ?string $stepID = null,
    ): self {
        $self = new self;

        $self['displayAndWait'] = $displayAndWait;

        null !== $instructions && $self['instructions'] = $instructions;
        null !== $loginID && $self['loginID'] = $loginID;
        null !== $stepID && $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * Parameters for the display and wait login step.
     *
     * @param DisplayAndWait|DisplayAndWaitShape $displayAndWait
     */
    public function withDisplayAndWait(
        DisplayAndWait|array $displayAndWait
    ): self {
        $self = clone $this;
        $self['displayAndWait'] = $displayAndWait;

        return $self;
    }

    /**
     * @param 'display_and_wait' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Human-readable instructions for completing this login step.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * An identifier for the current login process. Must be passed to execute more steps of the login.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * An unique ID identifying this step. This can be used to implement special behavior in clients.
     */
    public function withStepID(string $stepID): self
    {
        $self = clone $this;
        $self['stepID'] = $stepID;

        return $self;
    }
}
