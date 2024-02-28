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
use Psr\Container\ContainerExceptionInterface;

/**
 * PluginContainerException
 *
 * This class represents an exception that is thrown when a container error occurs.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 * @see    https://www.php-fig.org/psr/psr-11/#32-psrcontainercontainerexceptioninterface
 */
class PluginContainerException extends Exception implements ContainerExceptionInterface
{
}
