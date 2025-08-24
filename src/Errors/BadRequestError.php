<?php

namespace BeeperDesktop\Errors;

class BadRequestError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Bad Request Error';
}
