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
use RuntimeException;

use function is_object;

/**
 * PluginContainerTrait
 *
 * This trait represents a container for managing services and dependencies related to an ILIAS plugin.
 * The PluginContainerTrait provides the implementation of the PluginContainerInterface.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
trait PluginContainerTrait
{
    /**
     * @var PluginContainerInterface|null A singleton instance of the PluginContainer class.
     */
    private static ?PluginContainerInterface $instance = null;

    /**
     * @var Container The DI (Dependency Injection) container.
     */
    private Container $dic;

    /**
     * @var ContainerInterface The core DI container.
     */
    private ContainerInterface $core;

    /**
     * @var ContainerInterface The plugin DI container.
     */
    private ContainerInterface $plugin;

    /**
     * @var string The ID of the associated plugin.
     */
    private string $pluginId;

    /**
     * Initialize a new instance of PluginContainer.
     *
     * @param Container $dic      The DI container to be used.
     * @param string    $pluginId The ID of the associated plugin.
     *
     * @return PluginContainerInterface
     */
    public static function init(Container $dic, string $pluginId): PluginContainerInterface
    {
        return self::$instance = new self($dic, $pluginId);
    }

    /**
     * Get the singleton instance of PluginContainer.
     *
     * @return PluginContainerInterface
     * @throws RuntimeException If the PluginContainer is not initialized.
     */
    public static function get(): PluginContainerInterface
    {
        if (!self::$instance) {
            throw new RuntimeException('PluginContainer not initialized');
        }
        return self::$instance;
    }

    /**
     * Construct a new instance of PluginContainer.
     *
     * @param Container $dic      The DI container to be used.
     * @param string    $pluginId The ID of the associated plugin.
     */
    private function __construct(Container $dic, string $pluginId)
    {
        $this->pluginId = $pluginId;
        $this->dic = $dic;
        $this->plugin = new PluginContainerWrapper($dic, $pluginId);
    }

    /**
     * Get the core DI container.
     *
     * @return Container The ILIAS DI container.
     */
    public function core(): Container
    {
        return $this->dic;
    }

    /**
     * Get the plugin DI container.
     *
     * @return ContainerInterface The Plugin DI container.
     */
    public function plugin(): ContainerInterface
    {
        return $this->plugin;
    }

    /**
     * Register a service in the container.
     *
     * @param string   $id      The key to access the service.
     * @param callable $factory The function to register the service.
     *
     * @return self
     */
    public function register(string $id, callable $factory): self
    {
        $this->dic[$this->pluginId . '.' . $id] = $factory;

        return $this;
    }
}
