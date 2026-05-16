<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Bridges;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Bridges\Contacts\ContactListResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ContactsContract
{
    /**
     * @api
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
    ): ContactListResponse;
}
