<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\App\Login\LoginRegisterResponse;
use BeeperDesktop\App\Login\LoginResponseResponse\AppSetupCompleteResponse;
use BeeperDesktop\App\Login\LoginResponseResponse\AppSetupRegistrationRequiredResponse;
use BeeperDesktop\App\Login\LoginStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\LoginContract;
use BeeperDesktop\Services\App\Login\VerificationService;

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
     * @api
     */
    public VerificationService $verification;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LoginRawService($client);
        $this->verification = new VerificationService($client);
    }

    /**
     * @api
     *
     * Send a sign-in code to the user email address for app setup.
     *
     * @param string $email email address to send the sign-in code to
     * @param string $setupRequestID setup request ID returned by the start step
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function email(
        string $email,
        string $setupRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['email' => $email, 'setupRequestID' => $setupRequestID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->email(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a Beeper account after the user chooses a username and accepts the Terms of Use.
     *
     * @param string $leadToken registration token returned by Beeper
     * @param string $setupRequestID setup request ID returned by the start step
     * @param string $username username selected by the user
     * @param bool $acceptTerms Confirms that the user agreed to our [terms of use](https://www.beeper.com/terms-onboarding) and has read our [privacy policy](https://www.beeper.com/privacy).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function register(
        string $leadToken,
        string $setupRequestID,
        string $username,
        bool $acceptTerms = true,
        RequestOptions|array|null $requestOptions = null,
    ): LoginRegisterResponse {
        $params = Util::removeNulls(
            [
                'acceptTerms' => $acceptTerms,
                'leadToken' => $leadToken,
                'setupRequestID' => $setupRequestID,
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
     * Finish setup sign-in with the code sent to the user email address. If the user needs a new account, the response includes account creation copy and username suggestions.
     *
     * @param string $response sign-in code from the user email
     * @param string $setupRequestID setup request ID returned by the start step
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function response(
        string $response,
        string $setupRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): AppSetupCompleteResponse|AppSetupRegistrationRequiredResponse {
        $params = Util::removeNulls(
            ['response' => $response, 'setupRequestID' => $setupRequestID]
        );

        // @phpstan-ignore-next-line argument.type
        $response1 = $this->raw->response(params: $params, requestOptions: $requestOptions);

        return $response1->parse();
    }

    /**
     * @api
     *
     * Start setting up Beeper Desktop or Beeper Server. The flow supports existing Beeper accounts and new account creation.
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
