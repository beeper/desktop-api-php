<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\FindChatsRequest\Inbox;
use BeeperDesktop\Chats\FindChatsRequest\Type;
use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class FindChatsRequest implements BaseModel
{
    use SdkModel;

    /**
     * Provide an array of account IDs to filter chats from specific messaging accounts only.
     *
     * @var list<string>|null $accountIDs
     */
    #[Api(list: 'string', optional: true)]
    public ?array $accountIDs;

    /**
     * A cursor for use in pagination. ending_before is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, starting with obj_bar, your subsequent call can include ending_before=obj_bar in order to fetch the previous page of the list.
     */
    #[Api('ending_before', optional: true)]
    public ?string $endingBefore;

    /**
     * Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
     *
     * @var Inbox::*|null $inbox
     */
    #[Api(enum: Inbox::class, optional: true)]
    public ?string $inbox;

    /**
     * Include chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    #[Api(optional: true)]
    public ?bool $includeMuted;

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity after this time.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $lastActivityAfter;

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity before this time.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $lastActivityBefore;

    /**
     * Set the maximum number of chats to retrieve. Valid range: 1-200, default is 50.
     */
    #[Api(optional: true)]
    public ?int $limit;

    /**
     * Search string to filter chats by participant names. When multiple words provided, ALL words must match. Searches in username, displayName, and fullName fields.
     */
    #[Api(optional: true)]
    public ?string $participantQuery;

    /**
     * Search string to filter chats by title. When multiple words provided, ALL words must match. Matches are case-insensitive substrings.
     */
    #[Api(optional: true)]
    public ?string $query;

    /**
     * A cursor for use in pagination. starting_after is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, ending with obj_foo, your subsequent call can include starting_after=obj_foo in order to fetch the next page of the list.
     */
    #[Api('starting_after', optional: true)]
    public ?string $startingAfter;

    /**
     * Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, "channel" for channels, or "any" to get all types.
     *
     * @var Type::*|null $type
     */
    #[Api(enum: Type::class, optional: true)]
    public ?string $type;

    /**
     * Set to true to only retrieve chats that have unread messages.
     */
    #[Api(optional: true)]
    public ?bool $unreadOnly;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $accountIDs
     * @param Inbox::* $inbox
     * @param Type::* $type
     */
    public static function with(
        ?array $accountIDs = null,
        ?string $endingBefore = null,
        ?string $inbox = null,
        ?bool $includeMuted = null,
        ?\DateTimeInterface $lastActivityAfter = null,
        ?\DateTimeInterface $lastActivityBefore = null,
        ?int $limit = null,
        ?string $participantQuery = null,
        ?string $query = null,
        ?string $startingAfter = null,
        ?string $type = null,
        ?bool $unreadOnly = null,
    ): self {
        $obj = new self;

        null !== $accountIDs && $obj->accountIDs = $accountIDs;
        null !== $endingBefore && $obj->endingBefore = $endingBefore;
        null !== $inbox && $obj->inbox = $inbox;
        null !== $includeMuted && $obj->includeMuted = $includeMuted;
        null !== $lastActivityAfter && $obj->lastActivityAfter = $lastActivityAfter;
        null !== $lastActivityBefore && $obj->lastActivityBefore = $lastActivityBefore;
        null !== $limit && $obj->limit = $limit;
        null !== $participantQuery && $obj->participantQuery = $participantQuery;
        null !== $query && $obj->query = $query;
        null !== $startingAfter && $obj->startingAfter = $startingAfter;
        null !== $type && $obj->type = $type;
        null !== $unreadOnly && $obj->unreadOnly = $unreadOnly;

        return $obj;
    }

    /**
     * Provide an array of account IDs to filter chats from specific messaging accounts only.
     *
     * @param list<string> $accountIDs
     */
    public function withAccountIDs(array $accountIDs): self
    {
        $obj = clone $this;
        $obj->accountIDs = $accountIDs;

        return $obj;
    }

    /**
     * A cursor for use in pagination. ending_before is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, starting with obj_bar, your subsequent call can include ending_before=obj_bar in order to fetch the previous page of the list.
     */
    public function withEndingBefore(string $endingBefore): self
    {
        $obj = clone $this;
        $obj->endingBefore = $endingBefore;

        return $obj;
    }

    /**
     * Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
     *
     * @param Inbox::* $inbox
     */
    public function withInbox(string $inbox): self
    {
        $obj = clone $this;
        $obj->inbox = $inbox;

        return $obj;
    }

    /**
     * Include chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    public function withIncludeMuted(bool $includeMuted): self
    {
        $obj = clone $this;
        $obj->includeMuted = $includeMuted;

        return $obj;
    }

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity after this time.
     */
    public function withLastActivityAfter(
        \DateTimeInterface $lastActivityAfter
    ): self {
        $obj = clone $this;
        $obj->lastActivityAfter = $lastActivityAfter;

        return $obj;
    }

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity before this time.
     */
    public function withLastActivityBefore(
        \DateTimeInterface $lastActivityBefore
    ): self {
        $obj = clone $this;
        $obj->lastActivityBefore = $lastActivityBefore;

        return $obj;
    }

    /**
     * Set the maximum number of chats to retrieve. Valid range: 1-200, default is 50.
     */
    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj->limit = $limit;

        return $obj;
    }

    /**
     * Search string to filter chats by participant names. When multiple words provided, ALL words must match. Searches in username, displayName, and fullName fields.
     */
    public function withParticipantQuery(string $participantQuery): self
    {
        $obj = clone $this;
        $obj->participantQuery = $participantQuery;

        return $obj;
    }

    /**
     * Search string to filter chats by title. When multiple words provided, ALL words must match. Matches are case-insensitive substrings.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj->query = $query;

        return $obj;
    }

    /**
     * A cursor for use in pagination. starting_after is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, ending with obj_foo, your subsequent call can include starting_after=obj_foo in order to fetch the next page of the list.
     */
    public function withStartingAfter(string $startingAfter): self
    {
        $obj = clone $this;
        $obj->startingAfter = $startingAfter;

        return $obj;
    }

    /**
     * Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, "channel" for channels, or "any" to get all types.
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Set to true to only retrieve chats that have unread messages.
     */
    public function withUnreadOnly(bool $unreadOnly): self
    {
        $obj = clone $this;
        $obj->unreadOnly = $unreadOnly;

        return $obj;
    }
}
