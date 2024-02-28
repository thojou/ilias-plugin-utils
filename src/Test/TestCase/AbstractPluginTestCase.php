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

namespace Thojou\Ilias\Plugin\Utils\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Thojou\Ilias\Plugin\Utils\Test\ContainerMockHelperInterface;
use Thojou\Ilias\Plugin\Utils\Test\Traits\CommonHelperTrait;
use Thojou\Ilias\Plugin\Utils\Test\Traits\ContainerMockHelperTrait;
use Thojou\Ilias\Plugin\Utils\Test\Traits\PluginHelperTrait;

/**
 * AbstractPluginTestCase
 *
 * This abstract test case class provides common methods and utilities for testing ILIAS plugins.
 * It extends PHPUnit's TestCase class and includes traits for container mocking and common testing helpers.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
abstract class AbstractPluginTestCase extends TestCase implements ContainerMockHelperInterface
{
    use CommonHelperTrait;
    use ContainerMockHelperTrait;
    use PluginHelperTrait;
}
