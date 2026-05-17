<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications;

use BeeperDesktop\App\Verifications\VerificationListResponse\Item;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ItemShape from \BeeperDesktop\App\Verifications\VerificationListResponse\Item
 *
 * @phpstan-type VerificationListResponseShape = array{items: list<Item|ItemShape>}
 */
final class VerificationListResponse implements BaseModel
{
    /** @use SdkModel<VerificationListResponseShape> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Required(list: Item::class)]
    public array $items;

    /**
     * `new VerificationListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VerificationListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VerificationListResponse)->withItems(...)
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
     * @param list<Item|ItemShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<Item|ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
