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

namespace Thojou\Ilias\Plugin\Utils\Tests\Test\TestCase;

use ILIAS\Refinery\Factory as Refinery;
use PHPUnit\Framework\MockObject\MockObject;
use stdClass;
use Thojou\Ilias\Plugin\Utils\Test\TestCase\AbstractGUITestCase;

class AbstractGUITestCaseTest extends AbstractGUITestCase
{
    public function testExpectTplContent(): void
    {
        $template = $this->registerTemplate();
        $this->expectTplContent('test');
        $template->setContent('test');
    }

    public function testMockCommand(): void
    {
        $ctrl = $this->registerCtrl();
        $this->mockCommand('test');
        $this->assertSame('test', $ctrl->getCmd());
    }

    public function testExpectRedirect(): void
    {
        $method = 'redirect_method';
        $ctrl = $this->registerCtrl();
        $this->expectRedirect($this->once(), $method);

        $ctrl->redirect($this->createMock(stdClass::class), $method);
    }

    public function testMockPostRequest(): void
    {
        $properties = ['prop1' => 'value1', 'prop2' => 'value2'];
        $queryParameters = ['param1' => 'value1', 'param2' => 'value2'];

        $http = $this->registerHttp();
        $this->mockPostRequest($properties, $queryParameters);

        $this->assertEquals('POST', $_SERVER['REQUEST_METHOD']);
        $this->assertEquals($properties, $http->request()->getParsedBody());
        $this->assertEquals($queryParameters, $http->request()->getQueryParams());
    }

    public function testMockGETRequest(): void
    {
        $queryParameters = ['param1' => 'value1', 'param2' => 'value2'];

        $http = $this->registerHttp();
        $this->mockGetRequest($queryParameters);

        $this->assertEquals('GET', $_SERVER['REQUEST_METHOD']);
        $this->assertEquals($queryParameters, $http->request()->getQueryParams());
    }

    public function testSetupCommons(): void
    {
        $this->setupGUICommons();

        $this->assertInstanceOf(Refinery::class, $this->refinery);
        $this->assertInstanceOf(MockObject::class, $this->componentFactory);
        $this->assertInstanceOf(MockObject::class, $this->http);
        $this->assertInstanceOf(MockObject::class, $this->ctrl);
        $this->assertInstanceOf(MockObject::class, $this->tpl);
        $this->assertInstanceOf(MockObject::class, $this->language);
        $this->assertInstanceOf(MockObject::class, $this->user);
        $this->assertInstanceOf(MockObject::class, $this->styleDefinition);
    }

    protected function getPluginId(): string
    {
        return "test";
    }
}
