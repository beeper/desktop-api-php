<?php

namespace Tests\Services;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatNewResponse;
use BeeperDesktop\Chats\ChatStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\CursorNoLimit;
use BeeperDesktop\CursorSearch;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ChatsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(accessToken: 'My Access Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->chats->create(
            accountID: 'accountID',
            participantIDs: ['string'],
            type: 'single'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->chats->create(
            accountID: 'accountID',
            participantIDs: ['string'],
            type: 'single',
            messageText: 'messageText',
            title: 'title',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->chats->retrieve('!NCdzlIaMjZUmvmvyHU:beeper.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Chat::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->chats->update('!NCdzlIaMjZUmvmvyHU:beeper.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Chat::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->chats->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorNoLimit::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ChatListResponse::class, $item);
        }
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->chats->archive('!NCdzlIaMjZUmvmvyHU:beeper.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testMarkRead(): void
    {
        $result = $this->client->chats->markRead('!NCdzlIaMjZUmvmvyHU:beeper.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Chat::class, $result);
    }

    #[Test]
    public function testMarkUnread(): void
    {
        $result = $this->client->chats->markUnread(
            '!NCdzlIaMjZUmvmvyHU:beeper.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Chat::class, $result);
    }

    #[Test]
    public function testNotifyAnyway(): void
    {
        $result = $this->client->chats->notifyAnyway(
            '!NCdzlIaMjZUmvmvyHU:beeper.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Chat::class, $result);
    }

    #[Test]
    public function testSearch(): void
    {
        $page = $this->client->chats->search();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorSearch::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Chat::class, $item);
        }
    }

    #[Test]
    public function testStart(): void
    {
        $result = $this->client->chats->start(accountID: 'accountID', user: []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatStartResponse::class, $result);
    }

    #[Test]
    public function testStartWithOptionalParams(): void
    {
        $result = $this->client->chats->start(
            accountID: 'accountID',
            user: [
                'id' => 'id',
                'email' => 'email',
                'fullName' => 'fullName',
                'phoneNumber' => 'phoneNumber',
                'username' => 'username',
            ],
            allowInvite: true,
            messageText: 'messageText',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatStartResponse::class, $result);
    }
}
