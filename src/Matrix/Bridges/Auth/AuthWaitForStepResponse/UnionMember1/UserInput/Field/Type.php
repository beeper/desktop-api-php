<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput\Field;

/**
 * The type of field.
 */
enum Type: string
{
    case USERNAME = 'username';

    case PHONE_NUMBER = 'phone_number';

    case EMAIL = 'email';

    case PASSWORD = 'password';

    case _2FA_CODE = '2fa_code';

    case TOKEN = 'token';

    case URL = 'url';

    case DOMAIN = 'domain';

    case SELECT = 'select';
}
