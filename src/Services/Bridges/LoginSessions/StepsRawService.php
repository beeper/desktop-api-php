<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges\LoginSessions;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams;
use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams\Source;
use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams\Type;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginSessions\StepsRawContract;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class StepsRawService implements StepsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Submit input for the current step of a bridge login session.
     *
     * @param string $stepID path param: Current bridge login session step ID
     * @param array{
     *   bridgeID: string,
     *   loginSessionID: string,
     *   type: Type|value-of<Type>,
     *   fields?: array<string,string>,
     *   lastURL?: string,
     *   source?: Source|value-of<Source>,
     * }|StepSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginSession>
     *
     * @throws APIException
     */
    public function submit(
        string $stepID,
        array|StepSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = StepSubmitParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);
        $loginSessionID = $parsed['loginSessionID'];
        unset($parsed['loginSessionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'v1/bridges/%1$s/login-sessions/%2$s/steps/%3$s',
                $bridgeID,
                $loginSessionID,
                $stepID,
            ],
            body: (object) array_diff_key(
                $parsed,
                array_flip(['bridgeID', 'loginSessionID'])
            ),
            options: $options,
            convert: LoginSession::class,
        );
    }
}
