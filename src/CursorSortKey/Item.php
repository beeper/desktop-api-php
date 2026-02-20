<?php

declare(strict_types=1);

namespace BeeperDesktop\CursorSortKey;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type ItemShape = array{sortKey?: string|null}
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Optional]
    public ?string $sortKey;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $sortKey = null): self
    {
        $self = new self;

        null !== $sortKey && $self['sortKey'] = $sortKey;

        return $self;
    }

    public function withSortKey(string $sortKey): self
    {
        $self = clone $this;
        $self['sortKey'] = $sortKey;

        return $self;
    }
}
