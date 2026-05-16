<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\App\Login\LoginEmailParams;
use BeeperDesktop\App\Login\LoginRegisterParams;
use BeeperDesktop\App\Login\LoginRegisterResponse;
use BeeperDesktop\App\Login\LoginResponseParams;
use BeeperDesktop\App\Login\LoginResponseResponse;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember1;
use BeeperDesktop\App\Login\LoginStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\LoginRawContract;

/**
 * Complete first-party Beeper app login.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginRawService implements LoginRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Send a sign-in code to the user email address.
     *
     * @param array{email: string, request: string}|LoginEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function email(
        array|LoginEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LoginEmailParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/login/email',
            body: (object) $parsed,
            options: $options,
            convert: 'mixed',
            security: [],
        );
    }

    /**
     * @api
     *
     * Create a Beeper account after the user chooses a username and accepts the Terms of Use.
     *
     * @param array{
     *   acceptTerms: bool, leadToken: string, request: string, username: string
     * }|LoginRegisterParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginRegisterResponse>
     *
     * @throws APIException
     */
    public function register(
        array|LoginRegisterParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LoginRegisterParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/login/register',
            body: (object) $parsed,
            options: $options,
            convert: LoginRegisterResponse::class,
            security: [],
        );
    }

    /**
     * @api
     *
     * Finish sign-in with the code sent to the user email address. If the user needs a new account, the response includes account creation copy and username suggestions.
     *
     * @param array{request: string, response: string}|LoginResponseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UnionMember0|UnionMember1>
     *
     * @throws APIException
     */
    public function response(
        array|LoginResponseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LoginResponseParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/login/response',
            body: (object) $parsed,
            options: $options,
            convert: LoginResponseResponse::class,
            security: [],
        );
    }

    /**
     * @api
     *
     * Start a first-party Beeper Desktop sign-in session.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginStartResponse>
     *
     * @throws APIException
     */
    public function start(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/login/start',
            options: $requestOptions,
            convert: LoginStartResponse::class,
            security: [],
        );
    }
}
