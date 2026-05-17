<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Group creation capabilities for one group type.
 *
 * @phpstan-import-type GroupFieldCapabilityShape from \BeeperDesktop\Bridges\GroupFieldCapability
 *
 * @phpstan-type GroupTypeCapabilitiesShape = array{
 *   typeDescription: string,
 *   avatar?: null|GroupFieldCapability|GroupFieldCapabilityShape,
 *   disappear?: null|GroupFieldCapability|GroupFieldCapabilityShape,
 *   name?: null|GroupFieldCapability|GroupFieldCapabilityShape,
 *   parent?: null|GroupFieldCapability|GroupFieldCapabilityShape,
 *   participants?: null|GroupFieldCapability|GroupFieldCapabilityShape,
 *   topic?: null|GroupFieldCapability|GroupFieldCapabilityShape,
 *   username?: null|GroupFieldCapability|GroupFieldCapabilityShape,
 * }
 */
final class GroupTypeCapabilities implements BaseModel
{
    /** @use SdkModel<GroupTypeCapabilitiesShape> */
    use SdkModel;

    #[Required('type_description')]
    public string $typeDescription;

    /**
     * Group creation field capability.
     */
    #[Optional]
    public ?GroupFieldCapability $avatar;

    /**
     * Group creation field capability.
     */
    #[Optional]
    public ?GroupFieldCapability $disappear;

    /**
     * Group creation field capability.
     */
    #[Optional]
    public ?GroupFieldCapability $name;

    /**
     * Group creation field capability.
     */
    #[Optional]
    public ?GroupFieldCapability $parent;

    /**
     * Group creation field capability.
     */
    #[Optional]
    public ?GroupFieldCapability $participants;

    /**
     * Group creation field capability.
     */
    #[Optional]
    public ?GroupFieldCapability $topic;

    /**
     * Group creation field capability.
     */
    #[Optional]
    public ?GroupFieldCapability $username;

    /**
     * `new GroupTypeCapabilities()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GroupTypeCapabilities::with(typeDescription: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GroupTypeCapabilities)->withTypeDescription(...)
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
     * @param GroupFieldCapability|GroupFieldCapabilityShape|null $avatar
     * @param GroupFieldCapability|GroupFieldCapabilityShape|null $disappear
     * @param GroupFieldCapability|GroupFieldCapabilityShape|null $name
     * @param GroupFieldCapability|GroupFieldCapabilityShape|null $parent
     * @param GroupFieldCapability|GroupFieldCapabilityShape|null $participants
     * @param GroupFieldCapability|GroupFieldCapabilityShape|null $topic
     * @param GroupFieldCapability|GroupFieldCapabilityShape|null $username
     */
    public static function with(
        string $typeDescription,
        GroupFieldCapability|array|null $avatar = null,
        GroupFieldCapability|array|null $disappear = null,
        GroupFieldCapability|array|null $name = null,
        GroupFieldCapability|array|null $parent = null,
        GroupFieldCapability|array|null $participants = null,
        GroupFieldCapability|array|null $topic = null,
        GroupFieldCapability|array|null $username = null,
    ): self {
        $self = new self;

        $self['typeDescription'] = $typeDescription;

        null !== $avatar && $self['avatar'] = $avatar;
        null !== $disappear && $self['disappear'] = $disappear;
        null !== $name && $self['name'] = $name;
        null !== $parent && $self['parent'] = $parent;
        null !== $participants && $self['participants'] = $participants;
        null !== $topic && $self['topic'] = $topic;
        null !== $username && $self['username'] = $username;

        return $self;
    }

    public function withTypeDescription(string $typeDescription): self
    {
        $self = clone $this;
        $self['typeDescription'] = $typeDescription;

        return $self;
    }

    /**
     * Group creation field capability.
     *
     * @param GroupFieldCapability|GroupFieldCapabilityShape $avatar
     */
    public function withAvatar(GroupFieldCapability|array $avatar): self
    {
        $self = clone $this;
        $self['avatar'] = $avatar;

        return $self;
    }

    /**
     * Group creation field capability.
     *
     * @param GroupFieldCapability|GroupFieldCapabilityShape $disappear
     */
    public function withDisappear(GroupFieldCapability|array $disappear): self
    {
        $self = clone $this;
        $self['disappear'] = $disappear;

        return $self;
    }

    /**
     * Group creation field capability.
     *
     * @param GroupFieldCapability|GroupFieldCapabilityShape $name
     */
    public function withName(GroupFieldCapability|array $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Group creation field capability.
     *
     * @param GroupFieldCapability|GroupFieldCapabilityShape $parent
     */
    public function withParent(GroupFieldCapability|array $parent): self
    {
        $self = clone $this;
        $self['parent'] = $parent;

        return $self;
    }

    /**
     * Group creation field capability.
     *
     * @param GroupFieldCapability|GroupFieldCapabilityShape $participants
     */
    public function withParticipants(
        GroupFieldCapability|array $participants
    ): self {
        $self = clone $this;
        $self['participants'] = $participants;

        return $self;
    }

    /**
     * Group creation field capability.
     *
     * @param GroupFieldCapability|GroupFieldCapabilityShape $topic
     */
    public function withTopic(GroupFieldCapability|array $topic): self
    {
        $self = clone $this;
        $self['topic'] = $topic;

        return $self;
    }

    /**
     * Group creation field capability.
     *
     * @param GroupFieldCapability|GroupFieldCapabilityShape $username
     */
    public function withUsername(GroupFieldCapability|array $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
