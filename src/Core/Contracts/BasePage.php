<?php

declare(strict_types=1);

namespace BeeperDesktop\Core\Contracts;

use BeeperDesktop\Core\BaseClient;
use BeeperDesktop\Core\Pagination\PageRequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface BasePage
{
    public function __construct(
        BaseClient $client,
        PageRequestOptions $options,
        ResponseInterface $response,
        mixed $body,
    );
}
