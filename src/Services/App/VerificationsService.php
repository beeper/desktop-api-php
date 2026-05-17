<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\VerificationsContract;
use BeeperDesktop\Services\App\Verifications\QrService;
use BeeperDesktop\Services\App\Verifications\SASService;

/**
 * Manage device verification transactions.
 */
final class VerificationsService implements VerificationsContract
{
    /**
     * @api
     */
    public VerificationsRawService $raw;

    /**
     * @api
     */
    public QrService $qr;

    /**
     * @api
     */
    public SASService $sas;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VerificationsRawService($client);
        $this->qr = new QrService($client);
        $this->sas = new SASService($client);
    }
}
