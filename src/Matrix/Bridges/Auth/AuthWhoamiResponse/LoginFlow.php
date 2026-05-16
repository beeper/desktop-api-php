<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * An individual login flow which can be used to sign into the remote network.
 *
 * @phpstan-type LoginFlowShape = array{
 *   id: string, description: string, name: string
 * }
 */
final class LoginFlow implements BaseModel
{
    /** @use SdkModel<LoginFlowShape> */
    use SdkModel;

    /**
     * An internal ID that is passed to the /login/start call to start a login with this flow.
     */
    #[Required]
    public string $id;

    /**
     * A human-readable description of the login flow.
     */
    #[Required]
    public string $description;

    /**
     * A human-readable name for the login flow.
     */
    #[Required]
    public string $name;

    /**
     * `new LoginFlow()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginFlow::with(id: ..., description: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginFlow)->withID(...)->withDescription(...)->withName(...)
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
        string $description,
        string $name
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['description'] = $description;
        $self['name'] = $name;

        return $self;
    }

    /**
     * An internal ID that is passed to the /login/start call to start a login with this flow.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * A human-readable description of the login flow.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * A human-readable name for the login flow.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
