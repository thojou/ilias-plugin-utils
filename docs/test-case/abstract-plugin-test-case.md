# Using the `AbstractPluginTestCase` Class for Testing ILIAS Plugins

The `AbstractPluginTestCase` class is designed to simplify the testing of classes that extend the `ilPlugin` abstract class.
It combines multiple traits related to ILIAS plugins to streamline the test setup process and provide common testing utilities.

## Table of Contents
1. [Introduction](#1-introduction)
2. [Extending `AbstractPluginTestCase`](#2-extending-abstractplugintestcase)
3. [Traits Included](#3-traits-included)
4. [Common Testing Scenarios](#4-common-testing-scenarios)

## 1. Introduction

Testing ILIAS plugins is crucial for ensuring their functionality and compatibility with the ILIAS platform. 
However, setting up tests for ILIAS plugins can be complex and repetitive, often involving the configuration of ILIAS-specific components and services.

The `AbstractPluginTestCase` class simplifies the testing process by providing a common foundation for testing ILIAS ilPlugin classes.
It extends PHPUnit's `TestCase` class and includes several traits that offer utilities for container mocking and common testing scenarios.
This class is the preferred way to set up tests for ILIAS ilPlugin classes.

## 2. Extending `AbstractPluginTestCase`

To use the `AbstractPluginTestCase` class for testing your ILIAS plugin, 
create a test class that extends it. Here's an example of how to do it:

```php
use Thojou\Ilias\Plugin\Utils\Test\TestCase\AbstractPluginTestCase;

class YourPluginTest extends AbstractPluginTestCase
{
    // Your test methods go here.
}
```

By extending `AbstractPluginTestCase`, your test class inherits the functionality and utilities provided by the abstract class.

## 3. Traits Included

The `AbstractPluginTestCase` class includes several traits that simplify different aspects of ILIAS plugin testing:

* `CommonHelperTrait`: Provides common helper methods and properties for testing ILIAS plugins. It includes methods for registering and mocking various ILIAS core services and components.
* `ContainerMockHelperTrait`: Offers helper methods for mocking and managing services within the ILIAS DI (Dependency Injection) Container. This is especially useful for testing scenarios involving ILIAS plugins.
* `PluginHelperTrait`: Provides helper methods for testing ILIAS plugins that interact with the Component Repository. It includes methods for registering and managing a mocked Component Repository and setting expectations for its behavior.

## 4. Common Testing Scenarios

The `AbstractPluginTestCase` class simplifies common testing scenarios for ILIAS plugins, such as setting up and mocking essential ILIAS components,
managing services within the DI Container, and interacting with the Component Repository.

By using this abstract test case class and its included traits, you can streamline the testing process for your ILIAS plugins. 
This eliminates the need to manually configure ILIAS-specific components and services,
allowing you to focus on writing effective tests for your plugins.

```php
<?php

use Thojou\Ilias\Plugin\Utils\Test\TestCase\AbstractPluginTestCase;

class YourPluginTest extends AbstractPluginTestCase
{
    protected ilYourPlugin $plugin;
    
    protected function setUp() : void
    {
        $this->registerLanguage();
        $database = $this->registerDatabase();
        $componentRepository = $this->registerComponentRepository(ilYourPlugin::PLUGIN_ID);
        
        $this->plugin = new ilYourPlugin($database, $componentRepository, ilYourPlugin::PLUGIN_ID);
    }
    
    public function testIsValidParentType(): void
    {
        $this->assertTrue($this->plugin->isValidParentType("always"));
    }

    public function testCssFiles(): void
    {
        $this->assertEquals(['assets/css/styles.css'], $this->plugin->getCssFiles('any'));
    }

    protected function getPluginId(): string
    {
        return ilYourPlugin::PLUGIN_ID;
    }
}
```

In your test class that extends `AbstractPluginTestCase`, you can implement your test methods and leverage the provided utilities to ensure the functionality and reliability of your ILIAS plugins.

By following these guidelines and using the `AbstractPluginTestCase` class, you can improve the efficiency and quality of your ILIAS plugin testing, reducing repetition and duplications in your test setup.
