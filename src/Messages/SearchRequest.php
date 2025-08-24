<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Messages\SearchRequest\ChatType;
use BeeperDesktop\Messages\SearchRequest\Sender;

final class SearchRequest implements BaseModel
{
    use SdkModel;

    /**
     * Limit search to specific Beeper account IDs (bridge instances).
     *
     * @var list<string>|null $accountIDs
     */
    #[Api(list: 'string', optional: true)]
    public ?array $accountIDs;

    /**
     * Limit search to specific Beeper chat IDs.
     *
     * @var list<string>|null $chatIDs
     */
    #[Api(list: 'string', optional: true)]
    public ?array $chatIDs;

    /**
     * Filter by chat type: 'group' for group chats, 'single' for 1:1 chats.
     *
     * @var ChatType::*|null $chatType
     */
    #[Api(enum: ChatType::class, optional: true)]
    public ?string $chatType;

    /**
     * Only include messages with timestamp strictly after this ISO 8601 datetime (e.g., '2024-07-01T00:00:00Z' or '2024-07-01T00:00:00+02:00').
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $dateAfter;

    /**
     * Only include messages with timestamp strictly before this ISO 8601 datetime (e.g., '2024-07-31T23:59:59Z' or '2024-07-31T23:59:59+02:00').
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $dateBefore;

    /**
     * A cursor for use in pagination. ending_before is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, starting with obj_bar, your subsequent call can include ending_before=obj_bar in order to fetch the previous page of the list.
     */
    #[Api('ending_before', optional: true)]
    public ?string $endingBefore;

    /**
     * Exclude messages marked Low Priority by the user. Default: true. Set to false to include all.
     */
    #[Api(optional: true)]
    public ?bool $excludeLowPriority;

    /**
     * Include messages in chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    #[Api(optional: true)]
    public ?bool $includeMuted;

    /**
     * Maximum number of messages to return (1–500). Defaults to 50.
     */
    #[Api(optional: true)]
    public ?int $limit;

    /**
     * Only return messages that contain file attachments.
     */
    #[Api(optional: true)]
    public ?bool $onlyWithFile;

    /**
     * Only return messages that contain image attachments.
     */
    #[Api(optional: true)]
    public ?bool $onlyWithImage;

    /**
     * Only return messages that contain link attachments.
     */
    #[Api(optional: true)]
    public ?bool $onlyWithLink;

    /**
     * Only return messages that contain any type of media attachment.
     */
    #[Api(optional: true)]
    public ?bool $onlyWithMedia;

    /**
     * Only return messages that contain video attachments.
     */
    #[Api(optional: true)]
    public ?bool $onlyWithVideo;

    /**
     * Literal word search (NOT semantic). Finds messages containing these EXACT words in any order. Use single words users actually type, not concepts or phrases. Example: use "dinner" not "dinner plans", use "sick" not "health issues". If omitted, returns results filtered only by other parameters.
     */
    #[Api(optional: true)]
    public ?string $query;

    /**
     * Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
     *
     * @var Sender::*|string|null $sender
     */
    #[Api(union: Sender::class, optional: true)]
    public ?string $sender;

    /**
     * A cursor for use in pagination. starting_after is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, ending with obj_foo, your subsequent call can include starting_after=obj_foo in order to fetch the next page of the list.
     */
    #[Api('starting_after', optional: true)]
    public ?string $startingAfter;

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
     * @param list<string> $chatIDs
     * @param ChatType::* $chatType
     * @param Sender::*|string $sender
     */
    public static function with(
        ?array $accountIDs = null,
        ?array $chatIDs = null,
        ?string $chatType = null,
        ?\DateTimeInterface $dateAfter = null,
        ?\DateTimeInterface $dateBefore = null,
        ?string $endingBefore = null,
        ?bool $excludeLowPriority = null,
        ?bool $includeMuted = null,
        ?int $limit = null,
        ?bool $onlyWithFile = null,
        ?bool $onlyWithImage = null,
        ?bool $onlyWithLink = null,
        ?bool $onlyWithMedia = null,
        ?bool $onlyWithVideo = null,
        ?string $query = null,
        ?string $sender = null,
        ?string $startingAfter = null,
    ): self {
        $obj = new self;

        null !== $accountIDs && $obj->accountIDs = $accountIDs;
        null !== $chatIDs && $obj->chatIDs = $chatIDs;
        null !== $chatType && $obj->chatType = $chatType;
        null !== $dateAfter && $obj->dateAfter = $dateAfter;
        null !== $dateBefore && $obj->dateBefore = $dateBefore;
        null !== $endingBefore && $obj->endingBefore = $endingBefore;
        null !== $excludeLowPriority && $obj->excludeLowPriority = $excludeLowPriority;
        null !== $includeMuted && $obj->includeMuted = $includeMuted;
        null !== $limit && $obj->limit = $limit;
        null !== $onlyWithFile && $obj->onlyWithFile = $onlyWithFile;
        null !== $onlyWithImage && $obj->onlyWithImage = $onlyWithImage;
        null !== $onlyWithLink && $obj->onlyWithLink = $onlyWithLink;
        null !== $onlyWithMedia && $obj->onlyWithMedia = $onlyWithMedia;
        null !== $onlyWithVideo && $obj->onlyWithVideo = $onlyWithVideo;
        null !== $query && $obj->query = $query;
        null !== $sender && $obj->sender = $sender;
        null !== $startingAfter && $obj->startingAfter = $startingAfter;

        return $obj;
    }

    /**
     * Limit search to specific Beeper account IDs (bridge instances).
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
     * Limit search to specific Beeper chat IDs.
     *
     * @param list<string> $chatIDs
     */
    public function withChatIDs(array $chatIDs): self
    {
        $obj = clone $this;
        $obj->chatIDs = $chatIDs;

        return $obj;
    }

    /**
     * Filter by chat type: 'group' for group chats, 'single' for 1:1 chats.
     *
     * @param ChatType::* $chatType
     */
    public function withChatType(string $chatType): self
    {
        $obj = clone $this;
        $obj->chatType = $chatType;

        return $obj;
    }

    /**
     * Only include messages with timestamp strictly after this ISO 8601 datetime (e.g., '2024-07-01T00:00:00Z' or '2024-07-01T00:00:00+02:00').
     */
    public function withDateAfter(\DateTimeInterface $dateAfter): self
    {
        $obj = clone $this;
        $obj->dateAfter = $dateAfter;

        return $obj;
    }

    /**
     * Only include messages with timestamp strictly before this ISO 8601 datetime (e.g., '2024-07-31T23:59:59Z' or '2024-07-31T23:59:59+02:00').
     */
    public function withDateBefore(\DateTimeInterface $dateBefore): self
    {
        $obj = clone $this;
        $obj->dateBefore = $dateBefore;

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
     * Exclude messages marked Low Priority by the user. Default: true. Set to false to include all.
     */
    public function withExcludeLowPriority(bool $excludeLowPriority): self
    {
        $obj = clone $this;
        $obj->excludeLowPriority = $excludeLowPriority;

        return $obj;
    }

    /**
     * Include messages in chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    public function withIncludeMuted(bool $includeMuted): self
    {
        $obj = clone $this;
        $obj->includeMuted = $includeMuted;

        return $obj;
    }

    /**
     * Maximum number of messages to return (1–500). Defaults to 50.
     */
    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj->limit = $limit;

        return $obj;
    }

    /**
     * Only return messages that contain file attachments.
     */
    public function withOnlyWithFile(bool $onlyWithFile): self
    {
        $obj = clone $this;
        $obj->onlyWithFile = $onlyWithFile;

        return $obj;
    }

    /**
     * Only return messages that contain image attachments.
     */
    public function withOnlyWithImage(bool $onlyWithImage): self
    {
        $obj = clone $this;
        $obj->onlyWithImage = $onlyWithImage;

        return $obj;
    }

    /**
     * Only return messages that contain link attachments.
     */
    public function withOnlyWithLink(bool $onlyWithLink): self
    {
        $obj = clone $this;
        $obj->onlyWithLink = $onlyWithLink;

        return $obj;
    }

    /**
     * Only return messages that contain any type of media attachment.
     */
    public function withOnlyWithMedia(bool $onlyWithMedia): self
    {
        $obj = clone $this;
        $obj->onlyWithMedia = $onlyWithMedia;

        return $obj;
    }

    /**
     * Only return messages that contain video attachments.
     */
    public function withOnlyWithVideo(bool $onlyWithVideo): self
    {
        $obj = clone $this;
        $obj->onlyWithVideo = $onlyWithVideo;

        return $obj;
    }

    /**
     * Literal word search (NOT semantic). Finds messages containing these EXACT words in any order. Use single words users actually type, not concepts or phrases. Example: use "dinner" not "dinner plans", use "sick" not "health issues". If omitted, returns results filtered only by other parameters.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj->query = $query;

        return $obj;
    }

    /**
     * Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
     *
     * @param Sender::*|string $sender
     */
    public function withSender(string $sender): self
    {
        $obj = clone $this;
        $obj->sender = $sender;

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
}
