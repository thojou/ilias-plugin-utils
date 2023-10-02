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
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Thojou\Ilias\Plugin\Utils\Test\ContainerMockHelperInterface;
use Thojou\Ilias\Plugin\Utils\Test\Traits\ContainerMockHelperTrait;
use Thojou\Ilias\Plugin\Utils\Test\Traits\PluginHelperTrait;

class PluginHelperTraitTest extends TestCase implements ContainerMockHelperInterface
{
    use ContainerMockHelperTrait;
    use PluginHelperTrait;

    public function testRegisterComponentRepository(): void
    {
        $this->registerComponentRepository("TestID");

        $this->assertInstanceOf(MockObject::class, $this->componentRepository);
        $this->assertInstanceOf(ilComponentRepositoryWrite::class, $this->componentRepository);

        $this->assertTrue($this->componentRepository->hasPluginId('TestID'));
    }

    protected function getPluginId(): string
    {
        return 'test';
    }
}
