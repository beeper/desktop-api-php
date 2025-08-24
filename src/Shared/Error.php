<?php

declare(strict_types=1);

namespace BeeperDesktop\Shared;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class Error implements BaseModel
{
    use SdkModel;

    /**
     * Error message.
     */
    #[Api]
    public string $error;

    /**
     * Error code.
     */
    #[Api(optional: true)]
    public ?string $code;

    /**
     * Additional error details.
     *
     * @var array<string, string>|null $details
     */
    #[Api(map: 'string', optional: true)]
    public ?array $details;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(error: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withError(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, string> $details
     */
    public static function with(
        string $error,
        ?string $code = null,
        ?array $details = null
    ): self {
        $obj = new self;

        $obj->error = $error;

        null !== $code && $obj->code = $code;
        null !== $details && $obj->details = $details;

        return $obj;
    }

    /**
     * Error message.
     */
    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }

    /**
     * Error code.
     */
    public function withCode(string $code): self
    {
        $obj = clone $this;
        $obj->code = $code;

        return $obj;
    }

    /**
     * Additional error details.
     *
     * @param array<string, string> $details
     */
    public function withDetails(array $details): self
    {
        $obj = clone $this;
        $obj->details = $details;

        return $obj;
    }
}
