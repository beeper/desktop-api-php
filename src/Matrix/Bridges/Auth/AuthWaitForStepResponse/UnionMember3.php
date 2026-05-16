<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember3\Complete;

/**
 * Login complete.
 *
 * @phpstan-import-type CompleteShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember3\Complete
 *
 * @phpstan-type UnionMember3Shape = array{
 *   complete: Complete|CompleteShape,
 *   type: 'complete',
 *   instructions?: string|null,
 *   loginID?: string|null,
 *   stepID?: string|null,
 * }
 */
final class UnionMember3 implements BaseModel
{
    /** @use SdkModel<UnionMember3Shape> */
    use SdkModel;

    /** @var 'complete' $type */
    #[Required]
    public string $type = 'complete';

    /**
     * Information about the completed login.
     */
    #[Required]
    public Complete $complete;

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
     * `new UnionMember3()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember3::with(complete: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember3)->withComplete(...)
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
     * @param Complete|CompleteShape $complete
     */
    public static function with(
        Complete|array $complete,
        ?string $instructions = null,
        ?string $loginID = null,
        ?string $stepID = null,
    ): self {
        $self = new self;

        $self['complete'] = $complete;

        null !== $instructions && $self['instructions'] = $instructions;
        null !== $loginID && $self['loginID'] = $loginID;
        null !== $stepID && $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * Information about the completed login.
     *
     * @param Complete|CompleteShape $complete
     */
    public function withComplete(Complete|array $complete): self
    {
        $self = clone $this;
        $self['complete'] = $complete;

        return $self;
    }

    /**
     * @param 'complete' $type
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
