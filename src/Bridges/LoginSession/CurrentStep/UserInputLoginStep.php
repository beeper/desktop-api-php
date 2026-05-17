<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep;

use BeeperDesktop\Bridges\LoginInputField;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Core\Conversion\ListOf;

/**
 * @phpstan-import-type LoginInputFieldShape from \BeeperDesktop\Bridges\LoginInputField
 *
 * @phpstan-type UserInputLoginStepShape = array{
 *   fields: list<LoginInputField|LoginInputFieldShape>,
 *   stepID: string,
 *   type: 'user_input',
 *   attachments?: list<mixed>|null,
 *   instructions?: string|null,
 * }
 */
final class UserInputLoginStep implements BaseModel
{
    /** @use SdkModel<UserInputLoginStepShape> */
    use SdkModel;

    /** @var 'user_input' $type */
    #[Required]
    public string $type = 'user_input';

    /** @var list<LoginInputField> $fields */
    #[Required(list: LoginInputField::class)]
    public array $fields;

    #[Required]
    public string $stepID;

    /** @var list<mixed>|null $attachments */
    #[Optional(type: new ListOf('mixed', nullable: true))]
    public ?array $attachments;

    /**
     * User-facing instructions for this step.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * `new UserInputLoginStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserInputLoginStep::with(fields: ..., stepID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserInputLoginStep)->withFields(...)->withStepID(...)
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
     * @param list<LoginInputField|LoginInputFieldShape> $fields
     * @param list<mixed>|null $attachments
     */
    public static function with(
        array $fields,
        string $stepID,
        ?array $attachments = null,
        ?string $instructions = null,
    ): self {
        $self = new self;

        $self['fields'] = $fields;
        $self['stepID'] = $stepID;

        null !== $attachments && $self['attachments'] = $attachments;
        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param list<LoginInputField|LoginInputFieldShape> $fields
     */
    public function withFields(array $fields): self
    {
        $self = clone $this;
        $self['fields'] = $fields;

        return $self;
    }

    public function withStepID(string $stepID): self
    {
        $self = clone $this;
        $self['stepID'] = $stepID;

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
     * @param list<mixed> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * User-facing instructions for this step.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
