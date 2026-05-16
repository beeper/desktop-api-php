<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Contacts;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Contacts\ContactListResponse\Contact;

/**
 * @phpstan-import-type ContactShape from \BeeperDesktop\Matrix\Bridges\Contacts\ContactListResponse\Contact
 *
 * @phpstan-type ContactListResponseShape = array{
 *   contacts?: list<Contact|ContactShape>|null
 * }
 */
final class ContactListResponse implements BaseModel
{
    /** @use SdkModel<ContactListResponseShape> */
    use SdkModel;

    /** @var list<Contact>|null $contacts */
    #[Optional(list: Contact::class)]
    public ?array $contacts;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Contact|ContactShape>|null $contacts
     */
    public static function with(?array $contacts = null): self
    {
        $self = new self;

        null !== $contacts && $self['contacts'] = $contacts;

        return $self;
    }

    /**
     * @param list<Contact|ContactShape> $contacts
     */
    public function withContacts(array $contacts): self
    {
        $self = clone $this;
        $self['contacts'] = $contacts;

        return $self;
    }
}
