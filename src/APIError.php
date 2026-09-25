<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Core\Conversion\MapOf;

/**
 * @phpstan-type APIErrorShape = array{
 *   code: string, message: string, details?: array<string,mixed>|null
 * }
 */
final class APIError implements BaseModel
{
    /** @use SdkModel<APIErrorShape> */
    use SdkModel;

    #[Required]
    public string $code;

    #[Required]
    public string $message;

    /** @var array<string,mixed>|null $details */
    #[Optional(type: new MapOf('mixed', nullable: true))]
    public ?array $details;

    /**
     * `new APIError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * APIError::with(code: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new APIError)->withCode(...)->withMessage(...)
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
     * @param array<string,mixed>|null $details
     */
    public static function with(
        string $code,
        string $message,
        ?array $details = null
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;

        null !== $details && $self['details'] = $details;

        return $self;
    }

    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * @param array<string,mixed> $details
     */
    public function withDetails(array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }
}
