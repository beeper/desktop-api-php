<?php

namespace Tests\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\CursorSortKey;
use BeeperDesktop\Message;
use BeeperDesktop\Messages\MessageSendResponse;
use BeeperDesktop\Messages\MessageUpdateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class MessagesTest extends TestCase
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
    public function testUpdate(): void
    {
        $result = $this->client->messages->update(
            'messageID',
            chatID: '!NCdzlIaMjZUmvmvyHU:beeper.com',
            text: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MessageUpdateResponse::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->messages->update(
            'messageID',
            chatID: '!NCdzlIaMjZUmvmvyHU:beeper.com',
            text: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MessageUpdateResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->messages->list('!NCdzlIaMjZUmvmvyHU:beeper.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorSortKey::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Message::class, $item);
        }
    }

    #[Test]
    public function testSearch(): void
    {
        $page = $this->client->messages->search();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorSearch::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Message::class, $item);
        }
    }

    #[Test]
    public function testSend(): void
    {
        $result = $this->client->messages->send('!NCdzlIaMjZUmvmvyHU:beeper.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MessageSendResponse::class, $result);
    }
}
