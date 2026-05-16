<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Bridges;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListFlowsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListLoginsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember0;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember1;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember2;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember3;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AuthContract
{
    /**
     * @api
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listFlows(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): AuthListFlowsResponse;

    /**
     * @api
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listLogins(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): AuthListLoginsResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): UnionMember0|UnionMember1|UnionMember2|UnionMember3;

    /**
     * @api
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
    ): \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember3;

    /**
     * @api
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
    ): \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember3;

    /**
     * @api
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
    ): \BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember3;

    /**
     * @api
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function whoami(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): AuthWhoamiResponse;
}
