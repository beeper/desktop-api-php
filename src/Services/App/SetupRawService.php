<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\App\Setup\SetupEmailParams;
use BeeperDesktop\App\Setup\SetupGetResponse;
use BeeperDesktop\App\Setup\SetupRegisterParams;
use BeeperDesktop\App\Setup\SetupRegisterResponse;
use BeeperDesktop\App\Setup\SetupResponseParams;
use BeeperDesktop\App\Setup\SetupResponseResponse;
use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupCompleteResponse;
use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupRegistrationRequiredResponse;
use BeeperDesktop\App\Setup\SetupStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\SetupRawContract;

/**
 * Complete first-party Beeper app setup.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class SetupRawService implements SetupRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Return the current Beeper Desktop or Beeper Server sign-in and encrypted messaging setup state. This endpoint is public before sign-in so apps can discover that sign-in is needed; after sign-in, pass a read token.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SetupGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/app/setup',
            options: $requestOptions,
            convert: SetupGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Send a sign-in code to the user email address for app setup.
     *
     * @param array{email: string, setupRequestID: string}|SetupEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function email(
        array|SetupEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SetupEmailParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/email',
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: [],
        );
    }

    /**
     * @api
     *
     * Create a Beeper account after the user chooses a username and accepts the Terms of Use.
     *
     * @param array{
     *   acceptTerms?: bool,
     *   leadToken: string,
     *   setupRequestID: string,
     *   username: string,
     * }|SetupRegisterParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SetupRegisterResponse>
     *
     * @throws APIException
     */
    public function register(
        array|SetupRegisterParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SetupRegisterParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/register',
            body: (object) $parsed,
            options: $options,
            convert: SetupRegisterResponse::class,
            security: [],
        );
    }

    /**
     * @api
     *
     * Finish setup sign-in with the code sent to the user email address. If the user needs a new account, the response includes account creation copy and username suggestions.
     *
     * @param array{
     *   response: string, setupRequestID: string
     * }|SetupResponseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AppSetupCompleteResponse|AppSetupRegistrationRequiredResponse,>
     *
     * @throws APIException
     */
    public function response(
        array|SetupResponseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SetupResponseParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/response',
            body: (object) $parsed,
            options: $options,
            convert: SetupResponseResponse::class,
            security: [],
        );
    }

    /**
     * @api
     *
     * Start setting up Beeper Desktop or Beeper Server. The flow supports existing Beeper accounts and new account creation.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SetupStartResponse>
     *
     * @throws APIException
     */
    public function start(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/app/setup/start',
            options: $requestOptions,
            convert: SetupStartResponse::class,
            security: [],
        );
    }
}
