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

use ilPageComponentPlugin;
use ilPageComponentPluginGUI;
use ilPCPlugged;
use PHPUnit\Framework\TestCase;
use Thojou\Ilias\Plugin\Utils\Test\Traits\PageComponentHelperTrait;

class PageComponentHelperTraitTest extends TestCase
{
    use PageComponentHelperTrait;

    public function testRegisterPCPluggedGUI(): void
    {
        $this->registerPCPluggedGUI(["test" => "value"]);

        $contentObject = $this->pcGUI->getContentObject();

        $this->assertInstanceOf(ilPCPlugged::class, $contentObject);

        $this->assertEquals(
            ["test" => "value"],
            $contentObject->getProperties()
        );
    }

    public function testExpectPCGUICreate(): void
    {
        $this->registerPCPluggedGUI();

        $this->expectPCGUICreate($this->anything());
        $this->assertTrue($this->pcGUI->createElement([]));
    }

    public function testExpectPCGUIUpdate(): void
    {
        $this->registerPCPluggedGUI();

        $this->expectPCGUIUpdate($this->anything(), false);
        $this->assertFalse($this->pcGUI->updateElement([]));
    }

    public function testExecutePageComponentGUI(): void
    {
        $this->registerPCPluggedGUI();

        $gui = $this->createMock(ilPageComponentPluginGUI::class);
        $gui
            ->expects($this->once())
            ->method('setPlugin')
            ->with($this->isInstanceOf(ilPageComponentPlugin::class));

        $gui
            ->expects($this->once())
            ->method('setPCGUI')
            ->with($this->equalTo($this->pcGUI));

        $gui
            ->expects($this->once())
            ->method('executeCommand');

        $this->executePageComponentGUI($gui, ilPageComponentPlugin::class);
    }


}
