<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Bridges;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Bridges\Users\UserResolveParams;
use BeeperDesktop\Matrix\Bridges\Users\UserResolveResponse;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchParams;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface UsersRawContract
{
    /**
     * @api
     *
     * @param string $identifier path param: The identifier to resolve or start a chat with
     * @param array<string,mixed>|UserResolveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UserResolveResponse>
     *
     * @throws APIException
     */
    public function resolve(
        string $identifier,
        array|UserResolveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param array<string,mixed>|UserSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UserSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $bridgeID,
        array|UserSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
