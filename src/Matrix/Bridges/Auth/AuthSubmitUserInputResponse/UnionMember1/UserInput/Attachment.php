<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1\UserInput;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1\UserInput\Attachment\Info;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1\UserInput\Attachment\Type;

/**
 * A media attachment to show the user.
 *
 * @phpstan-import-type InfoShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1\UserInput\Attachment\Info
 *
 * @phpstan-type AttachmentShape = array{
 *   content: string,
 *   filename: string,
 *   type: Type|value-of<Type>,
 *   info?: null|Info|InfoShape,
 * }
 */
final class Attachment implements BaseModel
{
    /** @use SdkModel<AttachmentShape> */
    use SdkModel;

    /**
     * The raw file content for the attachment encoded in base64.
     */
    #[Required]
    public string $content;

    /**
     * The filename for the media attachment.
     */
    #[Required]
    public string $filename;

    /**
     * The type of media attachment, using the same media type identifiers as Matrix attachments. Only some are supported.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Optional but recommended metadata for the attachment. Can generally be derived from the raw content if omitted.
     */
    #[Optional]
    public ?Info $info;

    /**
     * `new Attachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Attachment::with(content: ..., filename: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Attachment)->withContent(...)->withFilename(...)->withType(...)
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
     * @param Info|InfoShape|null $info
     */
    public static function with(
        string $content,
        string $filename,
        Type|string $type,
        Info|array|null $info = null,
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['filename'] = $filename;
        $self['type'] = $type;

        null !== $info && $self['info'] = $info;

        return $self;
    }

    /**
     * The raw file content for the attachment encoded in base64.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * The filename for the media attachment.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * The type of media attachment, using the same media type identifiers as Matrix attachments. Only some are supported.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Optional but recommended metadata for the attachment. Can generally be derived from the raw content if omitted.
     *
     * @param Info|InfoShape $info
     */
    public function withInfo(Info|array $info): self
    {
        $self = clone $this;
        $self['info'] = $info;

        return $self;
    }
}
