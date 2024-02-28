<?php

namespace Thojou\Ilias\Plugin\Utils\Tests\DI;

use Exception;
use PHPUnit\Framework\TestCase;
use Thojou\Ilias\Plugin\Utils\DI\PluginContainerException;
use Thojou\Ilias\Plugin\Utils\DI\PluginContainerNotFoundException;
use Thojou\Ilias\Plugin\Utils\DI\PluginContainerWrapper;
use ILIAS\DI\Container;

class PluginContainerWrapperTest extends TestCase
{
    public function testGet()
    {
        $container = $this->createMock(Container::class);
        $container->method('offsetExists')->willReturn(true);
        $container->method('offsetGet')->willReturn('service');
        $pluginContainerWrapper = new PluginContainerWrapper($container);

        $this->assertEquals('service', $pluginContainerWrapper->get('service'));
    }

    public function testGetWithPrefix()
    {
        $container = $this->createMock(Container::class);
        $container->method('offsetExists')->willReturn(true);
        $container->method('offsetGet')->willReturn('service');
        $pluginContainerWrapper = new PluginContainerWrapper($container, 'prefix_');

        $this->assertEquals('service', $pluginContainerWrapper->get('service'));
    }

    public function testHas()
    {
        $container = $this->createMock(Container::class);
        $container->method('offsetExists')->willReturn(true);
        $pluginContainerWrapper = new PluginContainerWrapper($container);

        $this->assertTrue($pluginContainerWrapper->has('service'));
    }

    public function testHasReturnsFalse()
    {
        $container = $this->createMock(Container::class);
        $container->method('offsetExists')->willReturn(false);
        $pluginContainerWrapper = new PluginContainerWrapper($container);

        $this->assertFalse($pluginContainerWrapper->has('nonexistent_service'));
    }

    public function testGetThrowsNotFoundException()
    {
        $this->expectException(PluginContainerNotFoundException::class);

        $container = $this->createMock(Container::class);
        $container->method('offsetExists')->willReturn(false);
        $pluginContainerWrapper = new PluginContainerWrapper($container);

        $pluginContainerWrapper->get('nonexistent_service');
    }

    public function testGetThrowsContainerException()
    {
        $container = $this->createMock(Container::class);
        $container->method('offsetExists')->willReturn(true);
        $container->method('offsetGet')->will($this->throwException(new Exception()));
        $pluginContainerWrapper = new PluginContainerWrapper($container);

        $this->expectException(PluginContainerException::class);
        $pluginContainerWrapper->get('service_causing_exception');
    }
}