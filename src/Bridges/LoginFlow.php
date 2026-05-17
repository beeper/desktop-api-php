<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Connect or reconnect flow option for a bridge.
 *
 * @phpstan-type LoginFlowShape = array{
 *   id: string, description?: string|null, name?: string|null
 * }
 */
final class LoginFlow implements BaseModel
{
    /** @use SdkModel<LoginFlowShape> */
    use SdkModel;

    /**
     * Flow ID to pass when creating a bridge login session.
     */
    #[Required]
    public string $id;

    /**
     * Short explanation for when to use this flow, when provided.
     */
    #[Optional]
    public ?string $description;

    /**
     * Display name for the flow, when provided.
     */
    #[Optional]
    public ?string $name;

    /**
     * `new LoginFlow()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginFlow::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginFlow)->withID(...)
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
        string $id,
        ?string $description = null,
        ?string $name = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Flow ID to pass when creating a bridge login session.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Short explanation for when to use this flow, when provided.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Display name for the flow, when provided.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
