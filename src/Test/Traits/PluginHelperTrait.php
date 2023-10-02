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

use ilComponentRepositoryWrite;
use ilDBInterface;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * PluginHelperTrait
 *
 * This trait provides helper methods for testing ILIAS plugins that interact with the Component Repository.
 * It includes methods for registering and managing a mocked Component Repository and setting expectations for its behavior.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
trait PluginHelperTrait
{
    /**
     * @var ilComponentRepositoryWrite&MockObject The mocked Component Repository.
     */
    protected ilComponentRepositoryWrite $componentRepository;

    /**
     * @var ilDBInterface&object&MockObject The mocked database interface.
     */
    protected ilDBInterface $db;

    /**
     * Register a mocked Component Repository for a specific plugin ID.
     *
     * @param string $pluginId The ID of the plugin for which to register the Component Repository.
     *
     * @return ilComponentRepositoryWrite&MockObject The registered mocked Component Repository.
     */
    public function registerComponentRepository(string $pluginId): ilComponentRepositoryWrite
    {
        $this->componentRepository = $this->createMock(ilComponentRepositoryWrite::class);

        $this->componentRepository
            ->method('hasPluginId')
            ->with($this->equalTo($pluginId))
            ->willReturn(true);

        return $this->componentRepository;
    }

    /**
     * Register a mocked database interface and configure the core service to use it.
     *
     * @return ilDBInterface&MockObject The mocked database interface.
     */
    public function registerDatabase(): ilDBInterface
    {
        $this->db = $this->createMock(ilDBInterface::class);

        $this->mockCoreService('ilDB', $this->db);

        return $this->db;

    }
}
