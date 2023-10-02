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

namespace Thojou\Ilias\Plugin\Utils\Info;

use InvalidArgumentException;

use function array_map;
use function file_exists;
use function is_array;

/**
 * PluginInfo
 *
 * This class is responsible for resolving and extracting plugin information from a composer.json file.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PluginInfo
{
    /**
     * Resolve and extract plugin information from a composer.json file.
     *
     * @param string $composerJsonPath The path to the composer.json file.
     *
     * @return array<string, string> An associative array containing plugin information.
     *
     * @throws InvalidArgumentException If the composer.json file is missing or lacks required information.
     */
    public static function resolve(string $composerJsonPath): array
    {
        if (!file_exists($composerJsonPath)) {
            throw new InvalidArgumentException('composer.json not found at ' . $composerJsonPath);
        }

        $composerJson = (array)json_decode((string)file_get_contents($composerJsonPath), true);

        if (!isset($composerJson['authors']) || !is_array($composerJson['authors'])) {
            throw new InvalidArgumentException('composer.json does not contain authors information');
        }

        if (!isset($composerJson['extra']) || !is_array($composerJson['extra'])) {
            throw new InvalidArgumentException('composer.json does not contain extra information');
        }

        if (!isset($composerJson['extra']['ilias-plugin']) || !is_array($composerJson['extra']['ilias-plugin'])) {
            throw new InvalidArgumentException('composer.json does not contain ilias-plugin information');
        }

        $authorInfo = $composerJson['authors'];
        $pluginInfo = $composerJson['extra']['ilias-plugin'];

        if (!isset($pluginInfo['id'])) {
            throw new InvalidArgumentException('composer.json does not contain ilias-plugin.id information');
        }

        if (!isset($pluginInfo['version'])) {
            throw new InvalidArgumentException('composer.json does not contain ilias-plugin.version information');
        }

        if (!isset($pluginInfo['min_version'])) {
            throw new InvalidArgumentException('composer.json does not contain ilias-plugin.ilias_min_version information');
        }

        if (!isset($pluginInfo['max_version'])) {
            throw new InvalidArgumentException('composer.json does not contain ilias-plugin.ilias_max_version information');
        }

        return [
            'id' => $pluginInfo['id'],
            'version' => $pluginInfo['version'],
            'ilias_min_version' => $pluginInfo['min_version'],
            'ilias_max_version' => $pluginInfo['max_version'],
            'responsible' => join(", ", array_map(fn (array $author) => $author['name'], $authorInfo)),
            'responsible_mail' => join(", ", array_map(fn (array $author) => $author['email'], $authorInfo)),
        ];
    }

}
