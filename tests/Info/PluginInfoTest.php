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

use Thojou\Ilias\Plugin\Utils\Info\PluginInfo;
use PHPUnit\Framework\TestCase;

class PluginInfoTest extends TestCase
{
    /**
     * @dataProvider provideComposerJsonData
     *
     * @param string                $composerJsonPath
     * @param bool                  $expectException
     * @param array<string, string> $expectedResult
     */
    public function testResolve(
        string $composerJsonPath,
        bool $expectException,
        array $expectedResult
    ): void {
        if ($expectException) {
            $this->expectException(\InvalidArgumentException::class);
        }

        $result = PluginInfo::resolve($composerJsonPath);

        if (!$expectException) {
            $this->assertEquals($expectedResult, $result);
        }
    }

    /**
     * @return array<array{string, bool, array<string, string>}>
     */
    public function provideComposerJsonData(): array
    {
        return [
            [
                __DIR__ . '/fixtures/valid.composer.json',
                false,
                [
                    'id' => 'plugin_id',
                    'version' => '1.0.0',
                    'ilias_min_version' => '8',
                    'ilias_max_version' => '8.999',
                    'responsible' => 'Author Name',
                    'responsible_mail' => 'author@example.com',
                ],
            ],
            [
                __DIR__ . '/missing',
                true,
                [],
            ],
            [
                __DIR__ . '/fixtures/without_authors.composer.json',
                true,
                [],
            ],
            [
                __DIR__ . '/fixtures/without_extra.composer.json',
                true,
                [],
            ],
            [
                __DIR__ . '/fixtures/without_ilias_plugin.composer.json',
                true,
                [],
            ],
            [
                __DIR__ . '/fixtures/without_id.composer.json',
                true,
                [],
            ],
            [
                __DIR__ . '/fixtures/without_version.composer.json',
                true,
                [],
            ],
            [
                __DIR__ . '/fixtures/without_ilias_min_version.composer.json',
                true,
                [],
            ],
            [
                __DIR__ . '/fixtures//without_ilias_max_version.composer.json',
                true,
                [],
            ],
        ];
    }
}
