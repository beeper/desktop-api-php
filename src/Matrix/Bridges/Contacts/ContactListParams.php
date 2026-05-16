<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Contacts;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Get a list of contacts.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\ContactsService::list()
 *
 * @phpstan-type ContactListParamsShape = array{loginID?: string|null}
 */
final class ContactListParams implements BaseModel
{
    /** @use SdkModel<ContactListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An optional explicit login ID to do the action through.
     */
    #[Optional]
    public ?string $loginID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $loginID = null): self
    {
        $self = new self;

        null !== $loginID && $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * An optional explicit login ID to do the action through.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }
}
