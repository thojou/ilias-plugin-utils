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
     * @var ilDBInterface&object&MockObject The mocked database interface.
     */
    protected ilDBInterface $db;

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
