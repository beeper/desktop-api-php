<?php

declare(strict_types=1);

namespace BeeperDesktop\Error\Details\Issues;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Error\Details\Issues\Issue\Path;

/**
 * @phpstan-import-type PathVariants from \BeeperDesktop\Error\Details\Issues\Issue\Path
 * @phpstan-import-type PathShape from \BeeperDesktop\Error\Details\Issues\Issue\Path
 *
 * @phpstan-type IssueShape = array{
 *   code: string, message: string, path: list<PathShape>
 * }
 */
final class Issue implements BaseModel
{
    /** @use SdkModel<IssueShape> */
    use SdkModel;

    /**
     * Validation issue code.
     */
    #[Required]
    public string $code;

    /**
     * Human-readable description of the validation issue.
     */
    #[Required]
    public string $message;

    /**
     * Path pointing to the invalid field within the payload.
     *
     * @var list<PathVariants> $path
     */
    #[Required(list: Path::class)]
    public array $path;

    /**
     * `new Issue()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Issue::with(code: ..., message: ..., path: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Issue)->withCode(...)->withMessage(...)->withPath(...)
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
     * @param list<PathShape> $path
     */
    public static function with(
        string $code,
        string $message,
        array $path
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Validation issue code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Human-readable description of the validation issue.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Path pointing to the invalid field within the payload.
     *
     * @param list<PathShape> $path
     */
    public function withPath(array $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
