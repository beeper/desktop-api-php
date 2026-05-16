<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListFlowsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListLoginsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember0;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember1;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember2;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember3;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\AuthContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AuthService implements AuthContract
{
    /**
     * @api
     */
    public AuthRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AuthRawService($client);
    }

    /**
     * @api
     *
     * Get the available login flows.
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listFlows(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): AuthListFlowsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listFlows($bridgeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the login IDs of the current user.
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listLogins(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): AuthListLoginsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listLogins($bridgeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Log out of an existing login.
     *
     * @param string $loginID The unique ID of a login. Defined by the network connector.
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function logout(
        string $loginID,
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['bridgeID' => $bridgeID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->logout($loginID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
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
     * @param string $flowID path param: The login flow ID to use
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginID Query param: An existing login ID to re-login as. If this is specified and the user logs into a different account, the provided ID will be logged out.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function startLogin(
        string $flowID,
        string $bridgeID,
        ?string $loginID = null,
        RequestOptions|array|null $requestOptions = null,
    ): UnionMember0|UnionMember1|UnionMember2|UnionMember3 {
        $params = Util::removeNulls(
            ['bridgeID' => $bridgeID, 'loginID' => $loginID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->startLogin($flowID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Submit extracted cookies in a login process.
     *
     * @param string $stepID path param: The ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginProcessID path param: The ID of the login process, as returned in the `login_id` field of the start call
     * @param array<string,string> $body Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submitCookies(
        string $stepID,
        string $bridgeID,
        string $loginProcessID,
        array $body,
        RequestOptions|array|null $requestOptions = null,
    ): \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember3 {
        $params = Util::removeNulls(
            [
                'bridgeID' => $bridgeID,
                'loginProcessID' => $loginProcessID,
                'body' => $body,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submitCookies($stepID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Submit user input in a login process.
     *
     * @param string $stepID path param: The ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginProcessID path param: The ID of the login process, as returned in the `login_id` field of the start call
     * @param array<string,string> $body Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submitUserInput(
        string $stepID,
        string $bridgeID,
        string $loginProcessID,
        array $body,
        RequestOptions|array|null $requestOptions = null,
    ): \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember3 {
        $params = Util::removeNulls(
            [
                'bridgeID' => $bridgeID,
                'loginProcessID' => $loginProcessID,
                'body' => $body,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submitUserInput($stepID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Wait for the next step after displaying data to the user.
     *
     * @param string $stepID the ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginProcessID the ID of the login process, as returned in the `login_id` field of the start call
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function waitForStep(
        string $stepID,
        string $bridgeID,
        string $loginProcessID,
        RequestOptions|array|null $requestOptions = null,
    ): \BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember3 {
        $params = Util::removeNulls(
            ['bridgeID' => $bridgeID, 'loginProcessID' => $loginProcessID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->waitForStep($stepID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get all info that is useful for presenting this bridge in a manager interface.
     * * Server details: remote network details, available login flows, homeserver name, bridge bot user ID, command prefix
     * * User details: management room ID, list of logins with current state and info
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function whoami(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): AuthWhoamiResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->whoami($bridgeID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
