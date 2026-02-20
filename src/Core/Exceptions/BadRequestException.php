<?php

namespace BeeperDesktop\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Bad Request Exception';
}
