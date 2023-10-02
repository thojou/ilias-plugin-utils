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

namespace Thojou\Ilias\Plugin\Utils\Tests\Test\TestCase;

use ilDBInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Thojou\Ilias\Plugin\Utils\Test\TestCase\AbstractPluginTestCase;

class AbstractPluginTestCaseTest extends AbstractPluginTestCase
{
    public function testRegisterDatabase(): void
    {
        $this->registerDatabase();

        $this->assertInstanceOf(MockObject::class, $this->db);
        $this->assertInstanceOf(ilDBInterface::class, $this->db);
    }

    protected function getPluginId(): string
    {
        return "test";
    }
}
