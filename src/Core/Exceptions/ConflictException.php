<?php

namespace BeeperDesktop\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Conflict Exception';
}
