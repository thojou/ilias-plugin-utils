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

use Exception;
use ILIAS\DI\Container;
use Psr\Container\ContainerInterface;

/**
 * PluginContainerWrapper
 *
 * This class represents a wrapper for the ILIAS container to make it compatible with the PSR-11 container interface.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PluginContainerWrapper implements ContainerInterface
{
    /**
     * @var Container The ILIAS container.
     */
    private Container $container;

    /**
     * @var string|null The key prefix for the container.
     */
    private ?string $keyPrefix;

    /**
     * PluginContainerWrapper constructor.
     *
     * @param Container   $container The ILIAS container.
     * @param string|null $keyPrefix The key prefix for the container.
     */
    public function __construct(
        Container $container,
        ?string $keyPrefix = null
    ) {
        $this->container = $container;
        $this->keyPrefix = $keyPrefix;
    }

    /**
     * Get a service from the container.
     *
     * @param class-string<T> $id The id to access the service.
     *
     * @template T of mixed
     *
     * @return T                                The requested service.
     * @throws PluginContainerException
     * @throws PluginContainerNotFoundException
     */
    public function get(string $id)
    {
        $id = $this->resolveId($id);

        if(!isset($this->container[$id])) {
            throw new PluginContainerNotFoundException("Service with id '$id' not found in PluginContainer.");
        }

        try {
            return $this->container[$id];
        } catch (Exception $e) { // @phpstan-ignore-line
            throw new PluginContainerException("Error while getting service with id '$id' from PluginContainer.", 0, $e);
        }
    }

    /**
     * Check if a service is registered in the container.
     *
     * @param string $id The id to access the service.
     *
     * @return bool True if the service is registered, false otherwise.
     */
    public function has(string $id): bool
    {
        $id = $this->resolveId($id);

        return isset($this->container[$id]);
    }

    /**
     * Resolve the id with the key prefix.
     *
     * @param string $id
     *
     * @return string
     */
    private function resolveId(string $id): string
    {
        if ($this->keyPrefix === null) {
            return $id;
        }

        return sprintf("%s.%s", $this->keyPrefix, $id);
    }
}
