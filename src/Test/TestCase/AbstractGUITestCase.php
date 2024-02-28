<?php

declare(strict_types=1);

/*
 * This file is part of the ilias-plugin-utils Library for ILIAS.
 *
 * (c) Thomas Joußen <tjoussen@databay.de>
 *
 * This source file is subject to the GPL-3.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Thojou\Ilias\Plugin\Utils\Test\TestCase;

use ILIAS\HTTP\Wrapper\WrapperFactory;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Thojou\Ilias\Plugin\Utils\Test\ContainerMockHelperInterface;
use Thojou\Ilias\Plugin\Utils\Test\Traits\CommonHelperTrait;
use Thojou\Ilias\Plugin\Utils\Test\Traits\ContainerMockHelperTrait;

/**
 * AbstractGUITestCase
 *
 * This abstract test case class provides common methods and utilities for testing ILIAS plugin GUIs.
 * It extends PHPUnit's TestCase class and includes traits for container mocking and common testing helpers.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
abstract class AbstractGUITestCase extends TestCase implements ContainerMockHelperInterface
{
    use ContainerMockHelperTrait;
    use CommonHelperTrait;

    /**
     * Expect that the template content will be set to the specified expected content.
     *
     * @param mixed $expectedContent The expected content for the template.
     */
    public function expectTplContent($expectedContent): void
    {
        $this->tpl->expects($this->once())->method('setContent')->with($expectedContent);
    }

    /**
     * Mock a command by configuring the control object to return the specified command.
     *
     * @param string $command The command to be mocked.
     */
    public function mockCommand(string $command): void
    {
        $this->ctrl->method('getCmd')->willReturn($command);
    }

    /**
     * Expect that a redirect will be called with the specified method.
     *
     * @param InvocationOrder $expects The expected invocation order for the redirect method.
     * @param string          $method  The method to be redirected to.
     */
    public function expectRedirect(InvocationOrder $expects, string $method): void
    {
        $this->ctrl->expects($expects)
            ->method('redirect')
            ->with($this->anything(), $this->equalTo($method));
    }

    /**
     * Mock a POST request with the specified properties and optional query parameters.
     *
     * @param array<array-key, mixed> $properties      The properties to set in the POST request body.
     * @param array<array-key, mixed> $queryParameters Optional query parameters for the request.
     */
    public function mockPostRequest(array $properties, array $queryParameters = []): void
    {
        $this->http ?? $this->registerHttp();
        $this->request = $this->createMock(ServerRequestInterface::class);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->request->method('getServerParams')->willReturn(['REQUEST_METHOD' => 'POST']);
        $this->request->method('getParsedBody')->willReturn($properties);
        $this->request->method('getQueryParams')->willReturn($queryParameters);
        $this->http->method('request')->willReturn($this->request);
        $this->http->method('wrapper')->willReturn(new WrapperFactory($this->request));
    }

    /**
     * Mock a GET request with optional query parameters.
     *
     * @param array<array-key, mixed> $queryParameters Optional query parameters for the request.
     */
    public function mockGetRequest(array $queryParameters = []): void
    {
        $this->http ?? $this->registerHttp();
        $this->request = $this->createMock(ServerRequestInterface::class);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->request->method('getServerParams')->willReturn(['REQUEST_METHOD' => 'GET']);
        $this->request->method('getParsedBody')->willReturn([]);
        $this->request->method('getQueryParams')->willReturn($queryParameters);
        $this->http->method('request')->willReturn($this->request);
        $this->http->method('wrapper')->willReturn(new WrapperFactory($this->request));
    }
}
