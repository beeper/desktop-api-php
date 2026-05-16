<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Contacts\ContactListParams;
use BeeperDesktop\Matrix\Bridges\Contacts\ContactListResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\ContactsRawContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ContactsRawService implements ContactsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get a list of contacts.
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param array{loginID?: string}|ContactListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ContactListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        array|ContactListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ContactListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/contacts',
                $bridgeID,
            ],
            query: Util::array_transform_keys($parsed, ['loginID' => 'login_id']),
            options: $options,
            convert: ContactListResponse::class,
        );
    }
}
