<?php

namespace Tests\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewDmResponse;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewGroupResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RoomsTest extends TestCase
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
    public function testCreateDm(): void
    {
        $result = $this->client->matrix->bridges->rooms->createDm(
            'identifier',
            bridgeID: 'bridgeID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoomNewDmResponse::class, $result);
    }

    #[Test]
    public function testCreateDmWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->rooms->createDm(
            'identifier',
            bridgeID: 'bridgeID',
            loginID: 'bcc68892-b180-414f-9516-b4aadf7d0496',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoomNewDmResponse::class, $result);
    }

    #[Test]
    public function testCreateGroup(): void
    {
        $result = $this->client->matrix->bridges->rooms->createGroup(
            'groupType',
            bridgeID: 'bridgeID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoomNewGroupResponse::class, $result);
    }

    #[Test]
    public function testCreateGroupWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->rooms->createGroup(
            'groupType',
            bridgeID: 'bridgeID',
            loginID: 'bcc68892-b180-414f-9516-b4aadf7d0496',
            avatar: ['url' => 'url'],
            disappear: ['timer' => 0, 'type' => 'type'],
            name: ['name' => 'name'],
            parent: (object) [],
            participants: ['string'],
            roomID: 'room_id',
            topic: ['topic' => 'topic'],
            type: 'channel',
            username: 'username',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoomNewGroupResponse::class, $result);
    }
}
