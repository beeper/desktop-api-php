<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * This endpoint starts a new login process, which is used to log into the bridge.
 *
 * The basic flow of the entire login, including calling this endpoint, is:
 * 1. Call `GET /v3/login/flows` to get the list of available flows.
 *    If there's more than one flow, ask the user to pick which one they want to use.
 * 2. Call this endpoint with the chosen flow ID to start the login.
 *    The first login step will be returned.
 * 3. Render the information provided in the step.
 * 4. Call the `/login/step/...` endpoint corresponding to the step type:
 *    * For `user_input` and `cookies`, acquire the requested fields before calling the endpoint.
 *    * For `display_and_wait`, call the endpoint immediately
 *      (as there's nothing to acquire on the client side).
 * 5. Handle the data returned by the login step endpoint:
 *    * If an error is returned, the login has failed and must be restarted
 *      (from either step 1 or step 2) if the user wants to try again.
 *    * If step type `complete` is returned, the login finished successfully.
 *    * Otherwise, go to step 3 with the new data.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\AuthService::startLogin()
 *
 * @phpstan-type AuthStartLoginParamsShape = array{
 *   bridgeID: string, loginID?: string|null
 * }
 */
final class AuthStartLoginParams implements BaseModel
{
    /** @use SdkModel<AuthStartLoginParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $bridgeID;

    /**
     * An existing login ID to re-login as. If this is specified and the user logs into a different account, the provided ID will be logged out.
     */
    #[Optional]
    public ?string $loginID;

    /**
     * `new AuthStartLoginParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthStartLoginParams::with(bridgeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthStartLoginParams)->withBridgeID(...)
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
    public static function with(string $bridgeID, ?string $loginID = null): self
    {
        $self = new self;

        $self['bridgeID'] = $bridgeID;

        null !== $loginID && $self['loginID'] = $loginID;

        return $self;
    }

    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    /**
     * An existing login ID to re-login as. If this is specified and the user logs into a different account, the provided ID will be logged out.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }
}
