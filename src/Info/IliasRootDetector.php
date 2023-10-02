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

use Exception;

use function file_exists;
use function realpath;

/**
 * IliasRootDetector
 *
 * This class is responsible for detecting the root directory of an ILIAS installation.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class IliasRootDetector
{
    /**
     * Find the root directory of the ILIAS installation starting from the given directory.
     *
     * @param string $currentDir The directory to start the search from.
     *
     * @return string    The absolute path to the ILIAS root directory.
     * @throws Exception If the ILIAS root directory cannot be found.
     */
    public static function find(string $currentDir): string
    {
        if (file_exists($currentDir . '/ilias.php')) {
            return (string)realpath($currentDir);
        }

        if (realpath($currentDir) === '/') {
            throw new Exception('Could not find ILIAS root directory');
        }

        return self::find($currentDir . '/..');
    }
}
