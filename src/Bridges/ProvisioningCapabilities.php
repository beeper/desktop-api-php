<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Advanced network capabilities for account lookup and group creation.
 *
 * @phpstan-import-type GroupTypeCapabilitiesShape from \BeeperDesktop\Bridges\GroupTypeCapabilities
 * @phpstan-import-type ResolveIdentifierCapabilitiesShape from \BeeperDesktop\Bridges\ResolveIdentifierCapabilities
 *
 * @phpstan-type ProvisioningCapabilitiesShape = array{
 *   groupCreation: array<string,GroupTypeCapabilities|GroupTypeCapabilitiesShape>,
 *   resolveIdentifier: ResolveIdentifierCapabilities|ResolveIdentifierCapabilitiesShape,
 *   imagePackImport?: bool|null,
 * }
 */
final class ProvisioningCapabilities implements BaseModel
{
    /** @use SdkModel<ProvisioningCapabilitiesShape> */
    use SdkModel;

    /** @var array<string,GroupTypeCapabilities> $groupCreation */
    #[Required('group_creation', map: GroupTypeCapabilities::class)]
    public array $groupCreation;

    /**
     * Identifier lookup capabilities for this bridge.
     */
    #[Required('resolve_identifier')]
    public ResolveIdentifierCapabilities $resolveIdentifier;

    #[Optional('image_pack_import')]
    public ?bool $imagePackImport;

    /**
     * `new ProvisioningCapabilities()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProvisioningCapabilities::with(groupCreation: ..., resolveIdentifier: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProvisioningCapabilities)
     *   ->withGroupCreation(...)
     *   ->withResolveIdentifier(...)
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
     * @param array<string,GroupTypeCapabilities|GroupTypeCapabilitiesShape> $groupCreation
     * @param ResolveIdentifierCapabilities|ResolveIdentifierCapabilitiesShape $resolveIdentifier
     */
    public static function with(
        array $groupCreation,
        ResolveIdentifierCapabilities|array $resolveIdentifier,
        ?bool $imagePackImport = null,
    ): self {
        $self = new self;

        $self['groupCreation'] = $groupCreation;
        $self['resolveIdentifier'] = $resolveIdentifier;

        null !== $imagePackImport && $self['imagePackImport'] = $imagePackImport;

        return $self;
    }

    /**
     * @param array<string,GroupTypeCapabilities|GroupTypeCapabilitiesShape> $groupCreation
     */
    public function withGroupCreation(array $groupCreation): self
    {
        $self = clone $this;
        $self['groupCreation'] = $groupCreation;

        return $self;
    }

    /**
     * Identifier lookup capabilities for this bridge.
     *
     * @param ResolveIdentifierCapabilities|ResolveIdentifierCapabilitiesShape $resolveIdentifier
     */
    public function withResolveIdentifier(
        ResolveIdentifierCapabilities|array $resolveIdentifier
    ): self {
        $self = clone $this;
        $self['resolveIdentifier'] = $resolveIdentifier;

        return $self;
    }

    public function withImagePackImport(bool $imagePackImport): self
    {
        $self = clone $this;
        $self['imagePackImport'] = $imagePackImport;

        return $self;
    }
}
