<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Bridges;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Bridges\Users\UserResolveResponse;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface UsersContract
{
    /**
     * @api
     *
     * @param string $identifier path param: The identifier to resolve or start a chat with
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginID query param: An optional explicit login ID to do the action through
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resolve(
        string $identifier,
        string $bridgeID,
        ?string $loginID = null,
        RequestOptions|array|null $requestOptions = null,
    ): UserResolveResponse;

    /**
     * @api
     *
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginID query param: An optional explicit login ID to do the action through
     * @param string $query Body param: The search query to send to the remote network
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $bridgeID,
        ?string $loginID = null,
        ?string $query = null,
        RequestOptions|array|null $requestOptions = null,
    ): UserSearchResponse;
}
