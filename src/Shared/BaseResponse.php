<?php

declare(strict_types=1);

namespace BeeperDesktop\Shared;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class BaseResponse implements BaseModel
{
    use SdkModel;

    #[Api]
    public bool $success;

    #[Api(optional: true)]
    public ?string $error;

    /**
     * `new BaseResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BaseResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BaseResponse)->withSuccess(...)
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
     */
    public static function with(bool $success, ?string $error = null): self
    {
        $obj = new self;

        $obj->success = $success;

        null !== $error && $obj->error = $error;

        return $obj;
    }

    public function withSuccess(bool $success): self
    {
        $obj = clone $this;
        $obj->success = $success;

        return $obj;
    }

    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }
}
