<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput\Attachment;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput\Field;

/**
 * Parameters for the user input login step.
 *
 * @phpstan-import-type FieldShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput\Field
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput\Attachment
 *
 * @phpstan-type UserInputShape = array{
 *   fields: list<Field|FieldShape>,
 *   attachments?: list<Attachment|AttachmentShape>|null,
 * }
 */
final class UserInput implements BaseModel
{
    /** @use SdkModel<UserInputShape> */
    use SdkModel;

    /**
     * The list of fields that the user is requested to fill.
     *
     * @var list<Field> $fields
     */
    #[Required(list: Field::class)]
    public array $fields;

    /**
     * A list of media attachments to show the user alongside the form fields.
     *
     * @var list<Attachment>|null $attachments
     */
    #[Optional(list: Attachment::class)]
    public ?array $attachments;

    /**
     * `new UserInput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserInput::with(fields: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserInput)->withFields(...)
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
     * @param list<Field|FieldShape> $fields
     * @param list<Attachment|AttachmentShape>|null $attachments
     */
    public static function with(array $fields, ?array $attachments = null): self
    {
        $self = new self;

        $self['fields'] = $fields;

        null !== $attachments && $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * The list of fields that the user is requested to fill.
     *
     * @param list<Field|FieldShape> $fields
     */
    public function withFields(array $fields): self
    {
        $self = clone $this;
        $self['fields'] = $fields;

        return $self;
    }

    /**
     * A list of media attachments to show the user alongside the form fields.
     *
     * @param list<Attachment|AttachmentShape> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }
}
