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

namespace Thojou\Ilias\Plugin\Utils\Tests\Test\Traits;

use ilComponentRepositoryWrite;
use ILIAS\DI\Container;
use PHPUnit\Framework\TestCase;
use stdClass;
use Thojou\Ilias\Plugin\Utils\Test\ContainerMockHelperInterface;
use Thojou\Ilias\Plugin\Utils\Test\Traits\ContainerMockHelperTrait;
use Thojou\Ilias\Plugin\Utils\Test\Traits\PluginHelperTrait;

class ContainerHelperTraitTest extends TestCase implements ContainerMockHelperInterface
{
    use ContainerMockHelperTrait;
    use PluginHelperTrait;

    public function testMockCoreService(): void
    {
        $this->mockCoreService(stdClass::class, $this->createMock(stdClass::class));
        $DIC = $this->getDICMock();

        $this->assertInstanceOf(Container::class, $DIC);
        $this->assertArrayHasKey(stdClass::class, $DIC);
        $this->assertInstanceOf(stdClass::class, $DIC[stdClass::class]);
    }

    public function testMockPluginService(): void
    {
        $this->mockPluginService(stdClass::class, $this->createMock(stdClass::class));
        $DIC = $this->getDICMock();

        $this->assertInstanceOf(Container::class, $DIC);
        $this->assertArrayHasKey($this->getPluginId() . '.'. stdClass::class, $DIC);
        $this->assertInstanceOf(stdClass::class, $DIC[$this->getPluginId() . '.'. stdClass::class]);
    }

    protected function getPluginId(): string
    {
        return 'test';
    }
}
