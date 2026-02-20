<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts\Contacts;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\User;

/**
 * @phpstan-import-type UserShape from \BeeperDesktop\User
 *
 * @phpstan-type ContactSearchResponseShape = array{items: list<User|UserShape>}
 */
final class ContactSearchResponse implements BaseModel
{
    /** @use SdkModel<ContactSearchResponseShape> */
    use SdkModel;

    /** @var list<User> $items */
    #[Required(list: User::class)]
    public array $items;

    /**
     * `new ContactSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ContactSearchResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ContactSearchResponse)->withItems(...)
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
     * @param list<User|UserShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<User|UserShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
