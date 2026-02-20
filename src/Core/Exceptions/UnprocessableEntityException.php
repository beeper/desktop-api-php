<?php

namespace BeeperDesktop\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Unprocessable Entity Exception';
}
