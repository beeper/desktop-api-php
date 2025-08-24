<?php

declare(strict_types=1);

namespace BeeperDesktop\Contracts;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatFindParams\Inbox;
use BeeperDesktop\Chats\ChatFindParams\Type;
use BeeperDesktop\Chats\GetChatResponse;
use BeeperDesktop\Chats\LinkResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\Shared\BaseResponse;

interface ChatsContract
{
    /**
     * @param string $chatID Unique identifier of the chat to retrieve. Not available for iMessage chats. Participants are limited by 'maxParticipantCount'.
     * @param int|null $maxParticipantCount Maximum number of participants to return. Use -1 for all; otherwise 0–500. Defaults to 20.
     */
    public function retrieve(
        $chatID,
        $maxParticipantCount = null,
        ?RequestOptions $requestOptions = null,
    ): ?GetChatResponse;

    /**
     * @param string $chatID The identifier of the chat to archive or unarchive
     * @param bool $archived True to archive, false to unarchive
     */
    public function archive(
        $chatID,
        $archived = null,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @param list<string> $accountIDs Provide an array of account IDs to filter chats from specific messaging accounts only
     * @param string $endingBefore A cursor for use in pagination. ending_before is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, starting with obj_bar, your subsequent call can include ending_before=obj_bar in order to fetch the previous page of the list.
     * @param Inbox::* $inbox Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
     * @param bool $includeMuted Include chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     * @param \DateTimeInterface $lastActivityAfter Provide an ISO datetime string to only retrieve chats with last activity after this time
     * @param \DateTimeInterface $lastActivityBefore Provide an ISO datetime string to only retrieve chats with last activity before this time
     * @param int $limit Set the maximum number of chats to retrieve. Valid range: 1-200, default is 50
     * @param string $participantQuery Search string to filter chats by participant names. When multiple words provided, ALL words must match. Searches in username, displayName, and fullName fields.
     * @param string $query Search string to filter chats by title. When multiple words provided, ALL words must match. Matches are case-insensitive substrings.
     * @param string $startingAfter A cursor for use in pagination. starting_after is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, ending with obj_foo, your subsequent call can include starting_after=obj_foo in order to fetch the next page of the list.
     * @param Type::* $type Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, "channel" for channels, or "any" to get all types
     * @param bool $unreadOnly Set to true to only retrieve chats that have unread messages
     */
    public function find(
        $accountIDs = null,
        $endingBefore = null,
        $inbox = null,
        $includeMuted = null,
        $lastActivityAfter = null,
        $lastActivityBefore = null,
        $limit = null,
        $participantQuery = null,
        $query = null,
        $startingAfter = null,
        $type = null,
        $unreadOnly = null,
        ?RequestOptions $requestOptions = null,
    ): Chat;

    /**
     * @param string $chatID the ID of the chat to link to
     * @param string $messageSortKey Optional message sort key. Jumps to that message in the chat.
     */
    public function getLink(
        $chatID,
        $messageSortKey = null,
        ?RequestOptions $requestOptions = null
    ): LinkResponse;
}
