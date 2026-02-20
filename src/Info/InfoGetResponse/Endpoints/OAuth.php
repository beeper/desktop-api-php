<?php

declare(strict_types=1);

namespace BeeperDesktop\Info\InfoGetResponse\Endpoints;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type OAuthShape = array{
 *   authorizationEndpoint: string,
 *   introspectionEndpoint: string,
 *   registrationEndpoint: string,
 *   revocationEndpoint: string,
 *   tokenEndpoint: string,
 *   userinfoEndpoint: string,
 * }
 */
final class OAuth implements BaseModel
{
    /** @use SdkModel<OAuthShape> */
    use SdkModel;

    /**
     * OAuth authorization endpoint.
     */
    #[Required('authorization_endpoint')]
    public string $authorizationEndpoint;

    /**
     * OAuth introspection endpoint.
     */
    #[Required('introspection_endpoint')]
    public string $introspectionEndpoint;

    /**
     * OAuth dynamic client registration endpoint.
     */
    #[Required('registration_endpoint')]
    public string $registrationEndpoint;

    /**
     * OAuth token revocation endpoint.
     */
    #[Required('revocation_endpoint')]
    public string $revocationEndpoint;

    /**
     * OAuth token endpoint.
     */
    #[Required('token_endpoint')]
    public string $tokenEndpoint;

    /**
     * OAuth userinfo endpoint.
     */
    #[Required('userinfo_endpoint')]
    public string $userinfoEndpoint;

    /**
     * `new OAuth()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OAuth::with(
     *   authorizationEndpoint: ...,
     *   introspectionEndpoint: ...,
     *   registrationEndpoint: ...,
     *   revocationEndpoint: ...,
     *   tokenEndpoint: ...,
     *   userinfoEndpoint: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OAuth)
     *   ->withAuthorizationEndpoint(...)
     *   ->withIntrospectionEndpoint(...)
     *   ->withRegistrationEndpoint(...)
     *   ->withRevocationEndpoint(...)
     *   ->withTokenEndpoint(...)
     *   ->withUserinfoEndpoint(...)
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
        string $authorizationEndpoint,
        string $introspectionEndpoint,
        string $registrationEndpoint,
        string $revocationEndpoint,
        string $tokenEndpoint,
        string $userinfoEndpoint,
    ): self {
        $self = new self;

        $self['authorizationEndpoint'] = $authorizationEndpoint;
        $self['introspectionEndpoint'] = $introspectionEndpoint;
        $self['registrationEndpoint'] = $registrationEndpoint;
        $self['revocationEndpoint'] = $revocationEndpoint;
        $self['tokenEndpoint'] = $tokenEndpoint;
        $self['userinfoEndpoint'] = $userinfoEndpoint;

        return $self;
    }

    /**
     * OAuth authorization endpoint.
     */
    public function withAuthorizationEndpoint(
        string $authorizationEndpoint
    ): self {
        $self = clone $this;
        $self['authorizationEndpoint'] = $authorizationEndpoint;

        return $self;
    }

    /**
     * OAuth introspection endpoint.
     */
    public function withIntrospectionEndpoint(
        string $introspectionEndpoint
    ): self {
        $self = clone $this;
        $self['introspectionEndpoint'] = $introspectionEndpoint;

        return $self;
    }

    /**
     * OAuth dynamic client registration endpoint.
     */
    public function withRegistrationEndpoint(string $registrationEndpoint): self
    {
        $self = clone $this;
        $self['registrationEndpoint'] = $registrationEndpoint;

        return $self;
    }

    /**
     * OAuth token revocation endpoint.
     */
    public function withRevocationEndpoint(string $revocationEndpoint): self
    {
        $self = clone $this;
        $self['revocationEndpoint'] = $revocationEndpoint;

        return $self;
    }

    /**
     * OAuth token endpoint.
     */
    public function withTokenEndpoint(string $tokenEndpoint): self
    {
        $self = clone $this;
        $self['tokenEndpoint'] = $tokenEndpoint;

        return $self;
    }

    /**
     * OAuth userinfo endpoint.
     */
    public function withUserinfoEndpoint(string $userinfoEndpoint): self
    {
        $self = clone $this;
        $self['userinfoEndpoint'] = $userinfoEndpoint;

        return $self;
    }
}
