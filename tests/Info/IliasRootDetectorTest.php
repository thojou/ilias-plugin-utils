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

namespace Thojou\Ilias\Plugin\Utils\Tests\Info;

use PHPUnit\Framework\TestCase;
use Thojou\Ilias\Plugin\Utils\Info\IliasRootDetector;

use function realpath;

class IliasRootDetectorTest extends TestCase
{
    public function testFindIliasRootInCurrentDirectory(): void
    {
        $currentDir = __DIR__;
        $iliasRoot = IliasRootDetector::find($currentDir);
        $expected = realpath(__DIR__ . '/../../../../../../');

        $this->assertSame($expected, $iliasRoot);
    }

    public function testFindIliasRootInParentDirectory(): void
    {
        $currentDir = __DIR__ . '/../../';
        $iliasRoot = IliasRootDetector::find($currentDir);
        $expected = realpath(__DIR__ . '/../../../../../../');

        $this->assertSame($expected, $iliasRoot);
    }

    public function testFindIliasRootInRootDirectory(): void
    {
        $currentDir = '/';
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Could not find ILIAS root directory');

        IliasRootDetector::find($currentDir);
    }

    public function testFindIliasRootNonExistentFile(): void
    {
        $currentDir = '/tmp';
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Could not find ILIAS root directory');

        IliasRootDetector::find($currentDir);
    }
}
