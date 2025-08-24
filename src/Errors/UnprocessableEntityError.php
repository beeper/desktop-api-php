<?php

namespace BeeperDesktop\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Unprocessable Entity Error';
}
