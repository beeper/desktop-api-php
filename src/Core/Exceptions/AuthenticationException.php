<?php

namespace BeeperDesktop\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Authentication Exception';
}
