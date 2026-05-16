<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Users\UserResolveResponse;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\UsersContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class UsersService implements UsersContract
{
    /**
     * @api
     */
    public UsersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsersRawService($client);
    }

    /**
     * @api
     *
     * Resolve an identifier to a user on the remote network.
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
    ): UserResolveResponse {
        $params = Util::removeNulls(
            ['bridgeID' => $bridgeID, 'loginID' => $loginID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->resolve($identifier, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search for users on the remote network
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
    ): UserSearchResponse {
        $params = Util::removeNulls(['loginID' => $loginID, 'query' => $query]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search($bridgeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
