<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts\Contacts;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Search contacts on a specific account using merged account contacts, network search, and exact identifier lookup.
 *
 * @see BeeperDesktop\Services\Accounts\ContactsService::search()
 *
 * @phpstan-type ContactSearchParamsShape = array{query: string}
 */
final class ContactSearchParams implements BaseModel
{
    /** @use SdkModel<ContactSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text to search users by. Network-specific behavior.
     */
    #[Required]
    public string $query;

    /**
     * `new ContactSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ContactSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ContactSearchParams)->withQuery(...)
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
    public static function with(string $query): self
    {
        $self = new self;

        $self['query'] = $query;

        return $self;
    }

    /**
     * Text to search users by. Network-specific behavior.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
