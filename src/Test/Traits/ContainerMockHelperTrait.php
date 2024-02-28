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

use ILIAS\DI\Container;
use Thojou\Ilias\Plugin\Utils\Test\ContainerMockHelperInterface;

/**
 * ContainerMockHelperTrait
 *
 * This trait provides helper methods for mocking and managing services within the ILIAS DI (Dependency Injection) Container.
 * It is typically used in testing scenarios for ILIAS plugins.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
trait ContainerMockHelperTrait
{
    /**
     * @var array<string, object> An array to store mocked services.
     */
    private array $mockedServices = [];

    /**
     * Mock a core service by adding it to the DI Container and replacing the real service with a mock.
     *
     * @param string $key     The service key.
     * @param object $service The mocked service object.
     *
     * @return ContainerMockHelperInterface The current instance of the class implementing ContainerMockHelperInterface.
     */
    public function mockCoreService(string $key, object $service): ContainerMockHelperInterface
    {
        global $DIC;

        if (!$DIC instanceof Container) {
            $DIC = $this->getMockBuilder(Container::class)
                ->onlyMethods(['offsetExists', 'offsetGet'])
                ->disableOriginalConstructor()
                ->getMock();

            $DIC->method('offsetExists')
                ->willReturnCallback(function (string $key) {
                    return isset($this->mockedServices[$key]);
                });

            $DIC->method('offsetGet')
                ->willReturnCallback(function (string $key) {
                    return $this->mockedServices[$key];
                });
        }

        $this->mockedServices[$key] = $service;

        return $this;
    }

    /**
     * Mock a plugin-specific service by adding it to the DI Container with the plugin's ID prefix.
     *
     * @param string $key     The service key.
     * @param object $service The mocked service object.
     *
     * @return ContainerMockHelperInterface The current instance of the class implementing ContainerMockHelperInterface.
     */
    public function mockPluginService(string $key, object $service): ContainerMockHelperInterface
    {
        return $this->mockCoreService($this->getPluginId() . '.' . $key, $service);
    }

    /**
     * Get a mock of the ILIAS DI Container.
     *
     * @return Container The mock of the DI Container.
     */
    public function getDICMock(): Container
    {
        global $DIC;

        return $DIC;
    }

    /**
     * Get the plugin ID, which should be implemented by the class using this trait.
     *
     * @return string The plugin ID.
     */
    abstract protected function getPluginId(): string;
}
