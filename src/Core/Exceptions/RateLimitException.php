<?php

namespace BeeperDesktop\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Rate Limit Exception';
}
