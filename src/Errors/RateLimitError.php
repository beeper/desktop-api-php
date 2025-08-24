<?php

namespace BeeperDesktop\Errors;

class RateLimitError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Rate Limit Error';
}
