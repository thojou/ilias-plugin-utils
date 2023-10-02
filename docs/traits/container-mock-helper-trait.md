# Using the `ContainerMockHelperTrait` for ILIAS Plugin Testing

The `ContainerMockHelperTrait` is a testing utility trait that simplifies the testing of ILIAS plugins by providing helper methods for mocking and managing services within the ILIAS DI (Dependency Injection) Container. It is particularly useful in testing scenarios where you need to mock services within the container to isolate specific behaviors for testing.

## Table of

Contents
1. [Introduction](#1-introduction)
2. [Getting Started](#2-getting-started)
3. [Mocking Core and Plugin Services](#3-mocking-core-and-plugin-services)

## 1. Introduction

When testing ILIAS plugins, you often need to isolate and mock specific services within the ILIAS DI Container to control their behavior during testing. 
Manually setting up these mocks can be complex and time-consuming. 
The `ContainerMockHelperTrait` simplifies this process by providing predefined methods for mocking and managing services within the container.

> **Note:** The `ContainerMockHelperTrait` is already used inside `AbstractGUITestCase` and `AbstractPluginTestCase` classes.

## 2. Getting Started

To get started with the `ContainerMockHelperTrait`, you should include it in your test class. Here's an example of how to use it:

```php
use Thojou\Ilias\Plugin\Utils\Test\Traits\ContainerMockHelperTrait;

class YourPluginTest extends PHPUnit\Framework\TestCase
{
    use ContainerMockHelperTrait;
    
    protected function getPluginId() : string
    {
        return 'plugin_id';
    }
    
    // Your test methods go here.
}
```

The `getPluginId` method is required by the `ContainerMockHelperTrait` and should return the ID of your plugin.
By including the trait in your test class, you gain access to its helper methods.

## 3. Mocking Core and Plugin Services

The `ContainerMockHelperTrait` offers methods for mocking both core and plugin-specific services within the ILIAS DI Container. These methods allow you to isolate and control the behavior of services for testing purposes.

### 3.1. Mocking a Core Service

To mock a core service within the container, use the `mockCoreService` method. You need to provide the service key and the mocked service object:

```php
$this->mockCoreService('ilDB', $this->createMock(ilDBInterface::class));
```

This method replaces the real service with the specified mock, allowing you to control its behavior during testing.

### 3.2. Mocking a Plugin-Specific Service

To mock a plugin-specific service within the container, use the `mockPluginService` method. 
The service key is automatically prefixed with the plugin's ID:

```php
$this->mockPluginService(YourService::class, $this->createMock(YourService::class));
```

This method is useful when you want to isolate and control the behavior of services specific to your plugin during testing.

### 3.3. Getting a Mock of the ILIAS DI Container

To obtain a mock of the ILIAS DI Container, you can use the `getDICMock` method:

```php
$containerMock = $this->getDICMock();
```

This mock allows you to inspect and control the services registered within the container.

By following these guidelines and using the `ContainerMockHelperTrait`, you can streamline the process of mocking and managing services within the ILIAS DI Container for your plugin testing, making your tests more focused and effective.