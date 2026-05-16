<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListFlowsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListLoginsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthLogoutParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember0;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember1;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember2;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember3;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\AuthRawContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AuthRawService implements AuthRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the available login flows.
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuthListFlowsResponse>
     *
     * @throws APIException
     */
    public function listFlows(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/login/flows',
                $bridgeID,
            ],
            options: $requestOptions,
            convert: AuthListFlowsResponse::class,
        );
    }

    /**
     * @api
     *
     * Get the login IDs of the current user.
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuthListLoginsResponse>
     *
     * @throws APIException
     */
    public function listLogins(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/logins',
                $bridgeID,
            ],
            options: $requestOptions,
            convert: AuthListLoginsResponse::class,
        );
    }

    /**
     * @api
     *
     * Log out of an existing login.
     *
     * @param string $loginID The unique ID of a login. Defined by the network connector.
     * @param array{bridgeID: string}|AuthLogoutParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function logout(
        string $loginID,
        array|AuthLogoutParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthLogoutParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/logout/%2$s',
                $bridgeID,
                $loginID,
            ],
            options: $options,
            convert: 'mixed',
        );
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
     * @param array{bridgeID: string, loginID?: string}|AuthStartLoginParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UnionMember0|UnionMember1|UnionMember2|UnionMember3>
     *
     * @throws APIException
     */
    public function startLogin(
        string $flowID,
        array|AuthStartLoginParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthStartLoginParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/login/start/%2$s',
                $bridgeID,
                $flowID,
            ],
            query: Util::array_transform_keys($parsed, ['loginID' => 'login_id']),
            options: $options,
            convert: AuthStartLoginResponse::class,
        );
    }

    /**
     * @api
     *
     * Submit extracted cookies in a login process.
     *
     * @param string $stepID path param: The ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param array{
     *   bridgeID: string, loginProcessID: string, body: array<string,string>
     * }|AuthSubmitCookiesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuthSubmitCookiesResponse\UnionMember0|AuthSubmitCookiesResponse\UnionMember1|AuthSubmitCookiesResponse\UnionMember2|AuthSubmitCookiesResponse\UnionMember3,>
     *
     * @throws APIException
     */
    public function submitCookies(
        string $stepID,
        array|AuthSubmitCookiesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthSubmitCookiesParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);
        $loginProcessID = $parsed['loginProcessID'];
        unset($parsed['loginProcessID']);

        /** @var array<string,mixed> */
        $body = $parsed['body'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/login/step/%2$s/%3$s/cookies',
                $bridgeID,
                $loginProcessID,
                $stepID,
            ],
            body: array_diff_key($body, array_flip(['bridgeID', 'loginProcessID'])),
            options: $options,
            convert: AuthSubmitCookiesResponse::class,
        );
    }

    /**
     * @api
     *
     * Submit user input in a login process.
     *
     * @param string $stepID path param: The ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param array{
     *   bridgeID: string, loginProcessID: string, body: array<string,string>
     * }|AuthSubmitUserInputParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuthSubmitUserInputResponse\UnionMember0|AuthSubmitUserInputResponse\UnionMember1|AuthSubmitUserInputResponse\UnionMember2|AuthSubmitUserInputResponse\UnionMember3,>
     *
     * @throws APIException
     */
    public function submitUserInput(
        string $stepID,
        array|AuthSubmitUserInputParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthSubmitUserInputParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);
        $loginProcessID = $parsed['loginProcessID'];
        unset($parsed['loginProcessID']);

        /** @var array<string,mixed> */
        $body = $parsed['body'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/login/step/%2$s/%3$s/user_input',
                $bridgeID,
                $loginProcessID,
                $stepID,
            ],
            body: array_diff_key($body, array_flip(['bridgeID', 'loginProcessID'])),
            options: $options,
            convert: AuthSubmitUserInputResponse::class,
        );
    }

    /**
     * @api
     *
     * Wait for the next step after displaying data to the user.
     *
     * @param string $stepID the ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param array{
     *   bridgeID: string, loginProcessID: string
     * }|AuthWaitForStepParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuthWaitForStepResponse\UnionMember0|AuthWaitForStepResponse\UnionMember1|AuthWaitForStepResponse\UnionMember2|AuthWaitForStepResponse\UnionMember3,>
     *
     * @throws APIException
     */
    public function waitForStep(
        string $stepID,
        array|AuthWaitForStepParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthWaitForStepParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);
        $loginProcessID = $parsed['loginProcessID'];
        unset($parsed['loginProcessID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/login/step/%2$s/%3$s/display_and_wait',
                $bridgeID,
                $loginProcessID,
                $stepID,
            ],
            options: $options,
            convert: AuthWaitForStepResponse::class,
        );
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
     * @return BaseResponse<AuthWhoamiResponse>
     *
     * @throws APIException
     */
    public function whoami(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/whoami',
                $bridgeID,
            ],
            options: $requestOptions,
            convert: AuthWhoamiResponse::class,
        );
    }
}
