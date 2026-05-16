<?php

namespace Tests\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListFlowsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListLoginsResponse;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AuthTest extends TestCase
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
    public function testListFlows(): void
    {
        $result = $this->client->matrix->bridges->auth->listFlows('bridgeID');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AuthListFlowsResponse::class, $result);
    }

    #[Test]
    public function testListLogins(): void
    {
        $result = $this->client->matrix->bridges->auth->listLogins('bridgeID');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AuthListLoginsResponse::class, $result);
    }

    #[Test]
    public function testLogout(): void
    {
        $result = $this->client->matrix->bridges->auth->logout(
            'bcc68892-b180-414f-9516-b4aadf7d0496',
            bridgeID: 'bridgeID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testLogoutWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->auth->logout(
            'bcc68892-b180-414f-9516-b4aadf7d0496',
            bridgeID: 'bridgeID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testStartLogin(): void
    {
        $result = $this->client->matrix->bridges->auth->startLogin(
            'qr',
            bridgeID: 'bridgeID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testStartLoginWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->auth->startLogin(
            'qr',
            bridgeID: 'bridgeID',
            loginID: 'bcc68892-b180-414f-9516-b4aadf7d0496',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testSubmitCookies(): void
    {
        $result = $this->client->matrix->bridges->auth->submitCookies(
            'stepID',
            bridgeID: 'bridgeID',
            loginProcessID: 'loginProcessID',
            body: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testSubmitCookiesWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->auth->submitCookies(
            'stepID',
            bridgeID: 'bridgeID',
            loginProcessID: 'loginProcessID',
            body: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testSubmitUserInput(): void
    {
        $result = $this->client->matrix->bridges->auth->submitUserInput(
            'stepID',
            bridgeID: 'bridgeID',
            loginProcessID: 'loginProcessID',
            body: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testSubmitUserInputWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->auth->submitUserInput(
            'stepID',
            bridgeID: 'bridgeID',
            loginProcessID: 'loginProcessID',
            body: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testWaitForStep(): void
    {
        $result = $this->client->matrix->bridges->auth->waitForStep(
            'stepID',
            bridgeID: 'bridgeID',
            loginProcessID: 'loginProcessID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testWaitForStepWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->auth->waitForStep(
            'stepID',
            bridgeID: 'bridgeID',
            loginProcessID: 'loginProcessID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testWhoami(): void
    {
        $result = $this->client->matrix->bridges->auth->whoami('bridgeID');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AuthWhoamiResponse::class, $result);
    }
}
