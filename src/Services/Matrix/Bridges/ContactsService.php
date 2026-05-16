<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Contacts\ContactListResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\ContactsContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ContactsService implements ContactsContract
{
    /**
     * @api
     */
    public ContactsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ContactsRawService($client);
    }

    /**
     * @api
     *
     * Get a list of contacts.
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginID an optional explicit login ID to do the action through
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        ?string $loginID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ContactListResponse {
        $params = Util::removeNulls(['loginID' => $loginID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($bridgeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
