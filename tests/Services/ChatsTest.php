<?php

namespace Tests\Services;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Chats\ChatListResponse;
use BeeperDesktop\Chats\ChatNewResponse;
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
        $result = $this->client->chats->create();

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
}
