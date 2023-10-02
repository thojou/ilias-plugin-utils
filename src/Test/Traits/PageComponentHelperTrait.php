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

namespace Thojou\Ilias\Plugin\Utils\Test\Traits;

use ilPageComponentPlugin;
use ilPageComponentPluginGUI;
use ilPCPlugged;
use ilPCPluggedGUI;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * PageComponentHelperTrait
 *
 * This trait provides helper methods for testing ILIAS page component plugins.
 * It includes methods for registering and managing mocked page component plugins and GUIs, and for setting expectations
 * for their methods.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
trait PageComponentHelperTrait
{
    /**
     * @var ilPCPluggedGUI&MockObject The mocked page component plugin GUI.
     */
    protected ilPCPluggedGUI $pcGUI;

    /**
     * Register a mocked page component plugin GUI with optional properties.
     *
     * @param array<array-key, mixed> $properties Optional properties for the page component.
     *
     * @return ilPCPluggedGUI&MockObject The registered mocked page component plugin GUI.
     */
    public function registerPCPluggedGUI(array $properties = []): ilPCPluggedGUI
    {
        $this->pcGUI = $this->createMock(ilPCPluggedGUI::class);

        $pageContent = $this->createMock(ilPCPlugged::class);
        $pageContent
            ->method('getProperties')
            ->willReturn($properties);

        $this->pcGUI
            ->method('getContentObject')
            ->willReturn($pageContent);

        return $this->pcGUI;
    }

    /**
     * Set an expectation for the creation of a page component GUI element.
     *
     * @param Constraint $expected    The expected constraint.
     * @param bool       $willSucceed Whether the expectation will succeed.
     *
     * @return void
     */
    public function expectPCGUICreate(Constraint $expected, bool $willSucceed = true): void
    {
        $this->expectPCGUICommand('createElement', $expected, $willSucceed);
    }

    /**
     * Set an expectation for the update of a page component GUI element.
     *
     * @param Constraint $expected    The expected constraint.
     * @param bool       $willSucceed Whether the expectation will succeed.
     *
     * @return void
     */
    public function expectPCGUIUpdate(Constraint $expected, bool $willSucceed = true): void
    {
        $this->expectPCGUICommand('updateElement', $expected, $willSucceed);
    }

    /**
     * Execute a page component GUI with a given plugin and the mocked page component GUI.
     *
     * @param ilPageComponentPluginGUI            $gui         The page component GUI to execute.
     * @param class-string<ilPageComponentPlugin> $pluginClass The class name of the page component plugin.
     *
     * @return void
     */
    public function executePageComponentGUI(ilPageComponentPluginGUI $gui, string $pluginClass): void
    {
        $gui->setPlugin($this->createMock($pluginClass));
        $gui->setPCGUI($this->pcGUI);
        $gui->executeCommand();
    }

    /**
     * Set an expectation for a specific page component GUI command with expected parameters and success status.
     *
     * @param string     $command     The command to expect.
     * @param Constraint $expected    The expected constraint for the command's parameters.
     * @param bool       $willSucceed Whether the expectation will succeed.
     *
     * @return void
     */
    private function expectPCGUICommand(string $command, Constraint $expected, bool $willSucceed = true): void
    {
        $this->pcGUI->expects($this->once())->method($command)->with($expected)->willReturn($willSucceed);
    }
}
