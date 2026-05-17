<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Identifier lookup capabilities for this bridge.
 *
 * @phpstan-type ResolveIdentifierCapabilitiesShape = array{
 *   anyPhone: bool,
 *   contactList: bool,
 *   createDM: bool,
 *   lookupEmail: bool,
 *   lookupPhone: bool,
 *   lookupUsername: bool,
 *   search: bool,
 * }
 */
final class ResolveIdentifierCapabilities implements BaseModel
{
    /** @use SdkModel<ResolveIdentifierCapabilitiesShape> */
    use SdkModel;

    #[Required('any_phone')]
    public bool $anyPhone;

    #[Required('contact_list')]
    public bool $contactList;

    #[Required('create_dm')]
    public bool $createDM;

    #[Required('lookup_email')]
    public bool $lookupEmail;

    #[Required('lookup_phone')]
    public bool $lookupPhone;

    #[Required('lookup_username')]
    public bool $lookupUsername;

    #[Required]
    public bool $search;

    /**
     * `new ResolveIdentifierCapabilities()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResolveIdentifierCapabilities::with(
     *   anyPhone: ...,
     *   contactList: ...,
     *   createDM: ...,
     *   lookupEmail: ...,
     *   lookupPhone: ...,
     *   lookupUsername: ...,
     *   search: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResolveIdentifierCapabilities)
     *   ->withAnyPhone(...)
     *   ->withContactList(...)
     *   ->withCreateDM(...)
     *   ->withLookupEmail(...)
     *   ->withLookupPhone(...)
     *   ->withLookupUsername(...)
     *   ->withSearch(...)
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
    public static function with(
        bool $anyPhone,
        bool $contactList,
        bool $createDM,
        bool $lookupEmail,
        bool $lookupPhone,
        bool $lookupUsername,
        bool $search,
    ): self {
        $self = new self;

        $self['anyPhone'] = $anyPhone;
        $self['contactList'] = $contactList;
        $self['createDM'] = $createDM;
        $self['lookupEmail'] = $lookupEmail;
        $self['lookupPhone'] = $lookupPhone;
        $self['lookupUsername'] = $lookupUsername;
        $self['search'] = $search;

        return $self;
    }

    public function withAnyPhone(bool $anyPhone): self
    {
        $self = clone $this;
        $self['anyPhone'] = $anyPhone;

        return $self;
    }

    public function withContactList(bool $contactList): self
    {
        $self = clone $this;
        $self['contactList'] = $contactList;

        return $self;
    }

    public function withCreateDM(bool $createDM): self
    {
        $self = clone $this;
        $self['createDM'] = $createDM;

        return $self;
    }

    public function withLookupEmail(bool $lookupEmail): self
    {
        $self = clone $this;
        $self['lookupEmail'] = $lookupEmail;

        return $self;
    }

    public function withLookupPhone(bool $lookupPhone): self
    {
        $self = clone $this;
        $self['lookupPhone'] = $lookupPhone;

        return $self;
    }

    public function withLookupUsername(bool $lookupUsername): self
    {
        $self = clone $this;
        $self['lookupUsername'] = $lookupUsername;

        return $self;
    }

    public function withSearch(bool $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }
}
