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

use ilPlugin;
use ilPluginConfigGUI;

/**
 * ConfigGUIHelperTrait
 *
 * This trait provides helper methods for performing commands on ILIAS plugin configuration GUI objects.
 * It is intended to be used in test classes to simplify the testing of ILIAS plugins with configuration GUIs.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
trait ConfigGUIHelperTrait
{
    /**
     * Perform a command on an ILIAS plugin configuration GUI.
     *
     * @param string                 $command     The name of the command to be executed.
     * @param ilPluginConfigGUI      $gui         The instance of the ILIAS plugin configuration GUI.
     * @param class-string<ilPlugin> $pluginClass The class name of the ILIAS plugin object.
     *
     * @return void
     */
    public function performConfigGUICommand(string $command, ilPluginConfigGUI $gui, string $pluginClass): void
    {
        $gui->setPluginObject($this->createMock($pluginClass)); // @phpstan-ignore-line
        $gui->performCommand($command);
    }
}
