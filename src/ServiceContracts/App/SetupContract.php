<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App;

use BeeperDesktop\App\Setup\SetupGetResponse;
use BeeperDesktop\App\Setup\SetupRegisterResponse;
use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupCompleteResponse;
use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupRegistrationRequiredResponse;
use BeeperDesktop\App\Setup\SetupStartResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface SetupContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): SetupGetResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): SetupRegisterResponse;

    /**
     * @api
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
    ): AppSetupCompleteResponse|AppSetupRegistrationRequiredResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        RequestOptions|array|null $requestOptions = null
    ): SetupStartResponse;
}
