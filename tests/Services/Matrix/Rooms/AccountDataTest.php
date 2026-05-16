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
final class AccountDataTest extends TestCase
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
        $result = $this->client->matrix->rooms->accountData->retrieve(
            'org.example.custom.room.config',
            userID: '@alice:example.com',
            roomID: '!726s6s6q:example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->matrix->rooms->accountData->retrieve(
            'org.example.custom.room.config',
            userID: '@alice:example.com',
            roomID: '!726s6s6q:example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->matrix->rooms->accountData->update(
            'org.example.custom.room.config',
            userID: '@alice:example.com',
            roomID: '!726s6s6q:example.com',
            body: ['custom_account_data_key' => 'custom_account_data_value'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->matrix->rooms->accountData->update(
            'org.example.custom.room.config',
            userID: '@alice:example.com',
            roomID: '!726s6s6q:example.com',
            body: ['custom_account_data_key' => 'custom_account_data_value'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }
}
