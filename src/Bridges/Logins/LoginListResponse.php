<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\Logins;

use BeeperDesktop\Bridges\BridgeLogin;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BridgeLoginShape from \BeeperDesktop\Bridges\BridgeLogin
 *
 * @phpstan-type LoginListResponseShape = array{
 *   items: list<BridgeLogin|BridgeLoginShape>
 * }
 */
final class LoginListResponse implements BaseModel
{
    /** @use SdkModel<LoginListResponseShape> */
    use SdkModel;

    /** @var list<BridgeLogin> $items */
    #[Required(list: BridgeLogin::class)]
    public array $items;

    /**
     * `new LoginListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginListResponse)->withItems(...)
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
     * @param list<BridgeLogin|BridgeLoginShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<BridgeLogin|BridgeLoginShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
