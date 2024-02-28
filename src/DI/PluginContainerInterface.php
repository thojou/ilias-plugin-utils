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

namespace Thojou\Ilias\Plugin\Utils\DI;

use ILIAS\DI\Container;
use Psr\Container\ContainerInterface;

/**
 * PluginContainerInterface
 *
 * This interface represents a container for managing services and dependencies related to an ILIAS plugin.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
interface PluginContainerInterface
{
    /**
     * Register a service in the container.
     *
     * @param string   $id      The key to access the service.
     * @param callable $factory The function to register the service.
     *
     * @return self
     */
    public function register(string $id, callable $factory): self;

    /**
     * Get the core DI container.
     *
     * @return Container The ILIAS DI container.
     */
    public function core(): Container;

    /**
     * Get the plugin DI container.
     *
     * @return ContainerInterface The Plugin DI container.
     */
    public function plugin(): ContainerInterface;
}
