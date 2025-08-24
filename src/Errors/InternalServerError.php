<?php

namespace BeeperDesktop\Errors;

class InternalServerError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Internal Server Error';
}
