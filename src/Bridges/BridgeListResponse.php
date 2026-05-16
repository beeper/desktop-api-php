<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Bridge-backed account types and their connected accounts.
 *
 * @phpstan-import-type BridgeAvailabilityShape from \BeeperDesktop\Bridges\BridgeAvailability
 *
 * @phpstan-type BridgeListResponseShape = array{
 *   items: list<BridgeAvailability|BridgeAvailabilityShape>
 * }
 */
final class BridgeListResponse implements BaseModel
{
    /** @use SdkModel<BridgeListResponseShape> */
    use SdkModel;

    /** @var list<BridgeAvailability> $items */
    #[Required(list: BridgeAvailability::class)]
    public array $items;

    /**
     * `new BridgeListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BridgeListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BridgeListResponse)->withItems(...)
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
     * @param list<BridgeAvailability|BridgeAvailabilityShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<BridgeAvailability|BridgeAvailabilityShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
