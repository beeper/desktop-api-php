<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\Matrix\BridgesContract;
use BeeperDesktop\Services\Matrix\Bridges\AuthService;
use BeeperDesktop\Services\Matrix\Bridges\CapabilitiesService;
use BeeperDesktop\Services\Matrix\Bridges\ContactsService;
use BeeperDesktop\Services\Matrix\Bridges\RoomsService;
use BeeperDesktop\Services\Matrix\Bridges\UsersService;

/**
 * Matrix-compatible APIs for connected network bridges.
 */
final class BridgesService implements BridgesContract
{
    /**
     * @api
     */
    public BridgesRawService $raw;

    /**
     * @api
     */
    public AuthService $auth;

    /**
     * @api
     */
    public ContactsService $contacts;

    /**
     * @api
     */
    public UsersService $users;

    /**
     * @api
     */
    public RoomsService $rooms;

    /**
     * @api
     */
    public CapabilitiesService $capabilities;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BridgesRawService($client);
        $this->auth = new AuthService($client);
        $this->contacts = new ContactsService($client);
        $this->users = new UsersService($client);
        $this->rooms = new RoomsService($client);
        $this->capabilities = new CapabilitiesService($client);
    }
}
