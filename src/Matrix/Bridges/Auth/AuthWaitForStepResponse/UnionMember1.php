<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput;

/**
 * User input login step.
 *
 * @phpstan-import-type UserInputShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput
 *
 * @phpstan-type UnionMember1Shape = array{
 *   type: 'user_input',
 *   userInput: UserInput|UserInputShape,
 *   instructions?: string|null,
 *   loginID?: string|null,
 *   stepID?: string|null,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    /** @var 'user_input' $type */
    #[Required]
    public string $type = 'user_input';

    /**
     * Parameters for the user input login step.
     */
    #[Required('user_input')]
    public UserInput $userInput;

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
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(userInput: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember1)->withUserInput(...)
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
     * @param UserInput|UserInputShape $userInput
     */
    public static function with(
        UserInput|array $userInput,
        ?string $instructions = null,
        ?string $loginID = null,
        ?string $stepID = null,
    ): self {
        $self = new self;

        $self['userInput'] = $userInput;

        null !== $instructions && $self['instructions'] = $instructions;
        null !== $loginID && $self['loginID'] = $loginID;
        null !== $stepID && $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * @param 'user_input' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Parameters for the user input login step.
     *
     * @param UserInput|UserInputShape $userInput
     */
    public function withUserInput(UserInput|array $userInput): self
    {
        $self = clone $this;
        $self['userInput'] = $userInput;

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
