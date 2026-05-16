<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Bridges;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListFlowsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListLoginsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthLogoutParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember0;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember1;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember2;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember3;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepParams;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AuthRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $loginID The unique ID of a login. Defined by the network connector.
     * @param array<string,mixed>|AuthLogoutParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $flowID path param: The login flow ID to use
     * @param array<string,mixed>|AuthStartLoginParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $stepID path param: The ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param array<string,mixed>|AuthSubmitCookiesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember3,>
     *
     * @throws APIException
     */
    public function submitCookies(
        string $stepID,
        array|AuthSubmitCookiesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $stepID path param: The ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param array<string,mixed>|AuthSubmitUserInputParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember3,>
     *
     * @throws APIException
     */
    public function submitUserInput(
        string $stepID,
        array|AuthSubmitUserInputParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $stepID the ID of the step being submitted, as returned in the `step_id` field of the start call or the previous submit call
     * @param array<string,mixed>|AuthWaitForStepParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember0|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember2|\BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember3,>
     *
     * @throws APIException
     */
    public function waitForStep(
        string $stepID,
        array|AuthWaitForStepParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
