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

namespace Thojou\Ilias\Plugin\Utils\Tests\DI;

use stdClass;
use ILIAS\DI\Container;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Thojou\Ilias\Plugin\Utils\DI\PluginContainerNotFoundException;
use Thojou\Ilias\Plugin\Utils\DI\PluginContainerWrapper;
use Thojou\Ilias\Plugin\Utils\Tests\DI\Fixtures\TestPluginContainer;

class PluginContainerTest extends TestCase
{
    /**
     * @return void
     * @runInSeparateProcess needed because of static instance
     */
    public function testGetWithoutInit(): void
    {
        $this->expectException(RuntimeException::class);
        TestPluginContainer::get();
    }

    public function testUnknownService(): void
    {
        $this->expectException(PluginContainerNotFoundException::class);

        TestPluginContainer::init($this->createMock(Container::class), 'plugin_id');
        TestPluginContainer::get()->plugin()->get(stdClass::class);
    }

    public function testCore(): void
    {
        $DIC = $this->createMock(Container::class);
        TestPluginContainer::init($DIC, 'plugin_id');
        $this->assertSame($DIC, TestPluginContainer::get()->core());
    }

    public function testPlugin(): void
    {
        $DIC = $this->createMock(Container::class);
        TestPluginContainer::init($DIC, 'plugin_id');
        $this->assertInstanceOf(PluginContainerWrapper::class, TestPluginContainer::get()->plugin());
    }

    public function testRegister(): void
    {
        $DIC = $this->createMock(Container::class);
        $DIC
            ->expects($this->once())
            ->method('offsetSet')
            ->with($this->equalTo('plugin_id'.'.' . stdClass::class));


        TestPluginContainer::init($DIC, 'plugin_id');
        TestPluginContainer::get()->register(stdClass::class, fn () => $this->createMock(stdClass::class));
    }

    public function testGetService(): void
    {
        $service = $this->createMock(stdClass::class);
        $DIC = $this->createMock(Container::class);
        $DIC
            ->expects($this->once())
            ->method('offsetGet')
            ->with($this->equalTo('plugin_id'.'.' . stdClass::class))
            ->willReturn($service);

        TestPluginContainer::init($DIC, 'plugin_id');
        $this->assertSame($service, TestPluginContainer::get()->plugin()->get(stdClass::class));
    }

}
