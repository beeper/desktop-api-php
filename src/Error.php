<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Error\Details;

/**
 * @phpstan-import-type DetailsVariants from \BeeperDesktop\Error\Details
 * @phpstan-import-type DetailsShape from \BeeperDesktop\Error\Details
 *
 * @phpstan-type ErrorShape = array{
 *   code: string, message: string, details?: DetailsShape|null
 * }
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Machine-readable error code.
     */
    #[Required]
    public string $code;

    /**
     * Error message.
     */
    #[Required]
    public string $message;

    /**
     * Additional error details for debugging.
     *
     * @var DetailsVariants|null $details
     */
    #[Optional(union: Details::class)]
    public mixed $details;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(code: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withCode(...)->withMessage(...)
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
     * @param DetailsShape|null $details
     */
    public static function with(
        string $code,
        string $message,
        mixed $details = null
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;

        null !== $details && $self['details'] = $details;

        return $self;
    }

    /**
     * Machine-readable error code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Error message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Additional error details for debugging.
     *
     * @param DetailsShape $details
     */
    public function withDetails(mixed $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }
}
