<?php

namespace Tests\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Users\UserGetProfileResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class UsersTest extends TestCase
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
    public function testRetrieveProfile(): void
    {
        $result = $this->client->matrix->users->retrieveProfile(
            '@alice:example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UserGetProfileResponse::class, $result);
    }
}
