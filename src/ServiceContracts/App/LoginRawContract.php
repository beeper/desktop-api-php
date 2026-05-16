<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\App;

use BeeperDesktop\App\Login\LoginEmailParams;
use BeeperDesktop\App\Login\LoginRegisterParams;
use BeeperDesktop\App\Login\LoginRegisterResponse;
use BeeperDesktop\App\Login\LoginResponseParams;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember1;
use BeeperDesktop\App\Login\LoginStartResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface LoginRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LoginEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function email(
        array|LoginEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LoginRegisterParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginRegisterResponse>
     *
     * @throws APIException
     */
    public function register(
        array|LoginRegisterParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LoginResponseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UnionMember0|UnionMember1>
     *
     * @throws APIException
     */
    public function response(
        array|LoginResponseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginStartResponse>
     *
     * @throws APIException
     */
    public function start(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
