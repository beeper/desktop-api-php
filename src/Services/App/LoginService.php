<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\App\Login\LoginRegisterResponse;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember1;
use BeeperDesktop\App\Login\LoginStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\LoginContract;

/**
 * Complete first-party Beeper app login.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LoginService implements LoginContract
{
    /**
     * @api
     */
    public LoginRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LoginRawService($client);
    }

    /**
     * @api
     *
     * Send a sign-in code to the user email address.
     *
     * @param string $email email address to send the sign-in code to
     * @param string $request login request ID returned by the start step
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function email(
        string $email,
        string $request,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['email' => $email, 'request' => $request]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->email(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a Beeper account after the user chooses a username and accepts the Terms of Use.
     *
     * @param bool $acceptTerms confirms that the user accepted the Terms of Use and acknowledged the Privacy Policy
     * @param string $leadToken registration token returned by Beeper
     * @param string $request login request ID returned by the start step
     * @param string $username username selected by the user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function register(
        bool $acceptTerms,
        string $leadToken,
        string $request,
        string $username,
        RequestOptions|array|null $requestOptions = null,
    ): LoginRegisterResponse {
        $params = Util::removeNulls(
            [
                'acceptTerms' => $acceptTerms,
                'leadToken' => $leadToken,
                'request' => $request,
                'username' => $username,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->register(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Finish sign-in with the code sent to the user email address. If the user needs a new account, the response includes account creation copy and username suggestions.
     *
     * @param string $request login request ID returned by the start step
     * @param string $response sign-in code from the user email
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function response(
        string $request,
        string $response,
        RequestOptions|array|null $requestOptions = null,
    ): UnionMember0|UnionMember1 {
        $params = Util::removeNulls(
            ['request' => $request, 'response' => $response]
        );

        // @phpstan-ignore-next-line argument.type
        $response1 = $this->raw->response(params: $params, requestOptions: $requestOptions);

        return $response1->parse();
    }

    /**
     * @api
     *
     * Start a first-party Beeper Desktop sign-in session.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        RequestOptions|array|null $requestOptions = null
    ): LoginStartResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->start(requestOptions: $requestOptions);

        return $response->parse();
    }
}
