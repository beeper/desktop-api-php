<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\MatrixContract;
use BeeperDesktop\Services\Matrix\BridgesService;
use BeeperDesktop\Services\Matrix\RoomsService;
use BeeperDesktop\Services\Matrix\UsersService;

/**
 * Matrix-compatible APIs for accounts, rooms, and connected network bridges.
 */
final class MatrixService implements MatrixContract
{
    /**
     * @api
     */
    public MatrixRawService $raw;

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
    public BridgesService $bridges;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MatrixRawService($client);
        $this->users = new UsersService($client);
        $this->rooms = new RoomsService($client);
        $this->bridges = new BridgesService($client);
    }
}
