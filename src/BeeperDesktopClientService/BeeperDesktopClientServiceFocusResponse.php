<?php

declare(strict_types=1);

namespace BeeperDesktop\BeeperDesktopClientService;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Response indicating successful app focus action.
 *
 * @phpstan-type BeeperDesktopClientServiceFocusResponseShape = array{
 *   success: bool
 * }
 */
final class BeeperDesktopClientServiceFocusResponse implements BaseModel
{
    /** @use SdkModel<BeeperDesktopClientServiceFocusResponseShape> */
    use SdkModel;

    /**
     * Whether the app was successfully opened/focused.
     */
    #[Required]
    public bool $success;

    /**
     * `new BeeperDesktopClientServiceFocusResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeeperDesktopClientServiceFocusResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeeperDesktopClientServiceFocusResponse)->withSuccess(...)
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
     */
    public static function with(bool $success): self
    {
        $self = new self;

        $self['success'] = $success;

        return $self;
    }

    /**
     * Whether the app was successfully opened/focused.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
