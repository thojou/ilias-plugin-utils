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
use Thojou\Ilias\Plugin\Utils\DI\PluginContainer;
use ILIAS\DI\Container;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class PluginContainerTest extends TestCase
{
    /**
     * @return void
     * @runInSeparateProcess needed because of static instance
     */
    public function testGetWithoutInit(): void
    {
        $this->expectException(RuntimeException::class);
        PluginContainer::get();
    }

    public function testUnknownService(): void
    {
        $this->expectException(RuntimeException::class);

        PluginContainer::init($this->createMock(Container::class), 'plugin_id');
        PluginContainer::get()->getService(stdClass::class);
    }

    public function testCore(): void
    {
        $DIC = $this->createMock(Container::class);
        PluginContainer::init($DIC, 'plugin_id');
        $this->assertSame($DIC, PluginContainer::get()->core());
    }

    public function testRegister(): void
    {
        $DIC = $this->createMock(Container::class);
        $DIC
            ->expects($this->once())
            ->method('offsetSet')
            ->with($this->equalTo('plugin_id'.'.' . stdClass::class));


        PluginContainer::init($DIC, 'plugin_id');
        PluginContainer::get()->register(stdClass::class, fn () => $this->createMock(stdClass::class));
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

        PluginContainer::init($DIC, 'plugin_id');
        $this->assertSame($service, PluginContainer::get()->getService(stdClass::class));
    }
}
