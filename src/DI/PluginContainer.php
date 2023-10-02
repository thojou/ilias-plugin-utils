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

use RuntimeException;

use function is_object;

/**
 * PluginContainer
 *
 * This class represents a container for managing services and dependencies related to an ILIAS plugin.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PluginContainer
{
    /**
     * @var PluginContainer|null A singleton instance of the PluginContainer class.
     */
    private static ?PluginContainer $instance = null;

    /**
     * @var Container The DI (Dependency Injection) container.
     */
    private Container $dic;

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
     * @return self
     */
    public static function init(Container $dic, string $pluginId): self
    {
        return self::$instance = new self($dic, $pluginId);
    }

    /**
     * Get the singleton instance of PluginContainer.
     *
     * @return self
     * @throws RuntimeException If the PluginContainer is not initialized.
     */
    public static function get(): self
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
    }

    /**
     * Get the core DI container.
     *
     * @return Container The DI container.
     */
    public function core(): Container
    {
        return $this->dic;
    }

    /**
     * Get a service from the container.
     *
     * @template T of object
     *
     * @param class-string<T> $key The key to access the service.
     *
     * @return T                The requested service.
     * @throws RuntimeException If the service is not found.
     */
    public function getService(string $key): object
    {
        $service = $this->dic[$this->pluginId . '.' . $key];

        if (!is_object($service)) {
            throw new RuntimeException("Service $key not found for plugin $this->pluginId");
        }

        return $service; //@phpstan-ignore-line
    }

    /**
     * Register a service in the container.
     *
     * @param string   $key              The key to access the service.
     * @param callable $registerFunction The function to register the service.
     *
     * @return self
     */
    public function register(string $key, callable $registerFunction): self
    {
        $this->dic[$this->pluginId . '.' . $key] = $registerFunction;

        return $this;
    }
}
