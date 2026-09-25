<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App;

use BeeperDesktop\App\Setup\SetupEmailParams;
use BeeperDesktop\App\Setup\SetupGetResponse;
use BeeperDesktop\App\Setup\SetupRegisterParams;
use BeeperDesktop\App\Setup\SetupRegisterResponse;
use BeeperDesktop\App\Setup\SetupResponseParams;
use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupCompleteResponse;
use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupRegistrationRequiredResponse;
use BeeperDesktop\App\Setup\SetupStartResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface SetupRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SetupGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SetupEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function email(
        array|SetupEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SetupRegisterParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SetupRegisterResponse>
     *
     * @throws APIException
     */
    public function register(
        array|SetupRegisterParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SetupResponseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AppSetupCompleteResponse|AppSetupRegistrationRequiredResponse,>
     *
     * @throws APIException
     */
    public function response(
        array|SetupResponseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SetupStartResponse>
     *
     * @throws APIException
     */
    public function start(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
