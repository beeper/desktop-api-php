<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Contracts\MessagesContract;
use BeeperDesktop\Core\Conversion;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Messages\Message;
use BeeperDesktop\Messages\MessageDraftParams;
use BeeperDesktop\Messages\MessageSearchParams;
use BeeperDesktop\Messages\MessageSearchParams\ChatType;
use BeeperDesktop\Messages\MessageSearchParams\Sender;
use BeeperDesktop\Messages\MessageSendParams;
use BeeperDesktop\Messages\SendResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\Shared\BaseResponse;

/**
 * Send, draft, and search messages across all chat networks.
 */
final class MessagesService implements MessagesContract
{
    public function __construct(private Client $client) {}

    /**
     * Draft a message in a specific chat. This will be placed in the message input field without sending.
     *
     * @param string $chatID Provide the unique identifier of the chat where you want to draft a message
     * @param bool $focusApp Set to true to bring Beeper application to the foreground, or false to draft silently in background
     * @param string $text Provide the text content you want to draft. This will be placed in the message input field without sending
     */
    public function draft(
        $chatID,
        $focusApp = null,
        $text = null,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        $args = ['chatID' => $chatID, 'focusApp' => $focusApp, 'text' => $text];
        $args = Util::array_filter_null($args, ['focusApp', 'text']);
        [$parsed, $options] = MessageDraftParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v0/draft-message',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BaseResponse::class, value: $resp);
    }

    /**
     * Search messages across chats using Beeper's message index.
     *
     * @param list<string> $accountIDs limit search to specific Beeper account IDs (bridge instances)
     * @param list<string> $chatIDs limit search to specific Beeper chat IDs
     * @param ChatType::* $chatType filter by chat type: 'group' for group chats, 'single' for 1:1 chats
     * @param \DateTimeInterface $dateAfter Only include messages with timestamp strictly after this ISO 8601 datetime (e.g., '2024-07-01T00:00:00Z' or '2024-07-01T00:00:00+02:00').
     * @param \DateTimeInterface $dateBefore Only include messages with timestamp strictly before this ISO 8601 datetime (e.g., '2024-07-31T23:59:59Z' or '2024-07-31T23:59:59+02:00').
     * @param string $endingBefore A cursor for use in pagination. ending_before is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, starting with obj_bar, your subsequent call can include ending_before=obj_bar in order to fetch the previous page of the list.
     * @param bool $excludeLowPriority Exclude messages marked Low Priority by the user. Default: true. Set to false to include all.
     * @param bool $includeMuted Include messages in chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     * @param int $limit Maximum number of messages to return (1–500). Defaults to 50.
     * @param bool $onlyWithFile only return messages that contain file attachments
     * @param bool $onlyWithImage only return messages that contain image attachments
     * @param bool $onlyWithLink only return messages that contain link attachments
     * @param bool $onlyWithMedia only return messages that contain any type of media attachment
     * @param bool $onlyWithVideo only return messages that contain video attachments
     * @param string $query Literal word search (NOT semantic). Finds messages containing these EXACT words in any order. Use single words users actually type, not concepts or phrases. Example: use "dinner" not "dinner plans", use "sick" not "health issues". If omitted, returns results filtered only by other parameters.
     * @param Sender::*|string $sender Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
     * @param string $startingAfter A cursor for use in pagination. starting_after is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, ending with obj_foo, your subsequent call can include starting_after=obj_foo in order to fetch the next page of the list.
     */
    public function search(
        $accountIDs = null,
        $chatIDs = null,
        $chatType = null,
        $dateAfter = null,
        $dateBefore = null,
        $endingBefore = null,
        $excludeLowPriority = null,
        $includeMuted = null,
        $limit = null,
        $onlyWithFile = null,
        $onlyWithImage = null,
        $onlyWithLink = null,
        $onlyWithMedia = null,
        $onlyWithVideo = null,
        $query = null,
        $sender = null,
        $startingAfter = null,
        ?RequestOptions $requestOptions = null,
    ): Message {
        $args = [
            'accountIDs' => $accountIDs,
            'chatIDs' => $chatIDs,
            'chatType' => $chatType,
            'dateAfter' => $dateAfter,
            'dateBefore' => $dateBefore,
            'endingBefore' => $endingBefore,
            'excludeLowPriority' => $excludeLowPriority,
            'includeMuted' => $includeMuted,
            'limit' => $limit,
            'onlyWithFile' => $onlyWithFile,
            'onlyWithImage' => $onlyWithImage,
            'onlyWithLink' => $onlyWithLink,
            'onlyWithMedia' => $onlyWithMedia,
            'onlyWithVideo' => $onlyWithVideo,
            'query' => $query,
            'sender' => $sender,
            'startingAfter' => $startingAfter,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'accountIDs',
                'chatIDs',
                'chatType',
                'dateAfter',
                'dateBefore',
                'endingBefore',
                'excludeLowPriority',
                'includeMuted',
                'limit',
                'onlyWithFile',
                'onlyWithImage',
                'onlyWithLink',
                'onlyWithMedia',
                'onlyWithVideo',
                'query',
                'sender',
                'startingAfter',
            ],
        );
        [$parsed, $options] = MessageSearchParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v0/search-messages',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Message::class, value: $resp);
    }

    /**
     * Send a text message to a specific chat. Supports replying to existing messages. Returns the sent message ID and a deeplink to the chat.
     *
     * @param string $chatID The identifier of the chat where the message will send
     * @param string $replyToMessageID Provide a message ID to send this as a reply to an existing message
     * @param string $text Text content of the message you want to send. You may use markdown.
     */
    public function send(
        $chatID,
        $replyToMessageID = null,
        $text = null,
        ?RequestOptions $requestOptions = null,
    ): SendResponse {
        $args = [
            'chatID' => $chatID,
            'replyToMessageID' => $replyToMessageID,
            'text' => $text,
        ];
        $args = Util::array_filter_null($args, ['replyToMessageID', 'text']);
        [$parsed, $options] = MessageSendParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v0/send-message',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(SendResponse::class, value: $resp);
    }
}
