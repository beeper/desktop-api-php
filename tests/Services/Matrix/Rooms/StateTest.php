<?php

namespace Tests\Services\Matrix\Rooms;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class StateTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->matrix->rooms->state->retrieve(
            'state_key',
            roomID: '!636q39766251:example.com',
            eventType: 'm.room.name'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->matrix->rooms->state->retrieve(
            'state_key',
            roomID: '!636q39766251:example.com',
            eventType: 'm.room.name',
            format: 'content',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->matrix->rooms->state->list(
            '!636q39766251:example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }
}
