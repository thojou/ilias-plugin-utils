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
use ilDBInterface;
use ilPlugin;
use ilPluginConfigGUI;
use PHPUnit\Framework\TestCase;
use stdClass;
use Thojou\Ilias\Plugin\Utils\Test\ContainerMockHelperInterface;
use Thojou\Ilias\Plugin\Utils\Test\Traits\ConfigGUIHelperTrait;
use Thojou\Ilias\Plugin\Utils\Test\Traits\ContainerMockHelperTrait;

use function get_class;

class ConfigGUIHelperTraitTest extends TestCase implements ContainerMockHelperInterface
{
    use ContainerMockHelperTrait;
    use ConfigGUIHelperTrait;

    public function testPerformCommand(): void
    {
        $gui = $this->getMockBuilder(ilPluginConfigGUI::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['performCommand'])
            ->getMock();

        $gui
            ->expects($this->once())
            ->method('performCommand')
            ->with($this->equalTo('testCmd'));

        $this->performConfigGUICommand('testCmd', $gui, ilPlugin::class);
    }

    protected function getPluginId(): string
    {
        return 'test';
    }
}
