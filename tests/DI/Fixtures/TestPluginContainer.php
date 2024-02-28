<?php

namespace Thojou\Ilias\Plugin\Utils\Tests\DI\Fixtures;

use Thojou\Ilias\Plugin\Utils\DI\PluginContainerInterface;
use Thojou\Ilias\Plugin\Utils\DI\PluginContainerTrait;

class TestPluginContainer implements PluginContainerInterface
{
    use PluginContainerTrait;
}