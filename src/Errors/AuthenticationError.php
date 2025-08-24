<?php

namespace BeeperDesktop\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Authentication Error';
}
