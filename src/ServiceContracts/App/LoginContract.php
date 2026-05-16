<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App;

use BeeperDesktop\App\Login\LoginRegisterResponse;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember1;
use BeeperDesktop\App\Login\LoginStartResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface LoginContract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): LoginRegisterResponse;

    /**
     * @api
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
    ): UnionMember0|UnionMember1;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        RequestOptions|array|null $requestOptions = null
    ): LoginStartResponse;
}
