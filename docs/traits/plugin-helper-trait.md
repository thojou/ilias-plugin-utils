# Using the `PluginHelperTrait` for Testing ILIAS Plugins with Component Repository

The `PluginHelperTrait` is a testing utility trait designed to simplify the testing of ILIAS plugins that interact with the Component Repository.
It provides helper methods for registering and managing a mocked Component Repository and setting expectations for its behavior during testing.
This trait is particularly useful when testing plugins that rely on the Component Repository for various operations.

## Table of Contents
1. [Introduction](#1-introduction)
2. [Getting Started](#2-getting-started)
3. [Registering and Managing the Component Repository](#3-registering-and-managing-the-component-repository)
4. [Setting Expectations](#4-setting-expectations)

## 1. Introduction

Testing ILIAS plugins that interact with the Component Repository often requires mocking and controlling the behavior of the repository.
Manually managing this can be complex and error-prone. The `PluginHelperTrait` simplifies this process by providing methods
for registering and managing a mocked Component Repository and setting expectations for its behavior during testing.

> **Note:** The `PluginHelperTrait` is already used inside `AbstractPluginTestCase` classes.

## 2. Getting Started

To get started with the `PluginHelperTrait`, include it in your test class. Here's an example of how to use it:

```php
use Thojou\Ilias\Plugin\Utils

\Test\Traits\PluginHelperTrait;

class YourPluginTest extends PHPUnit\Framework\TestCase
{
    use PluginHelperTrait;
    
    // Your test methods go here.
}
```

By including the trait in your test class, you gain access to its helper methods.

## 3. Registering and Managing the Component Repository

The `PluginHelperTrait` provides a method for registering and managing a mocked Component Repository for a specific plugin ID.
This allows you to isolate and control the behavior of the Component Repository during testing.

### 3.1. Registering a Mocked Component Repository

To register a mocked Component Repository for a specific plugin ID, use the `registerComponentRepository` method:

```php
$componentRepository = $this->registerComponentRepository('your_plugin_id');
```

This method returns the registered mocked Component Repository, allowing you to set up expectations and control its behavior.
Per default, it mocks the `hasPluginId` method to return true for the given plugin ID.

### 3.1. Registering a Mocked Database

To register a mocked ilDBInterface, use the `registerDatabase` method:

```php
$componentRepository = $this->registerDatabase();
```

This method returns the registered mocked ilDBInterface, allowing you to set up expectations and control its behavior.

By following these guidelines and using the `PluginHelperTrait`, you can streamline the testing of ILIAS plugins that rely on the 
Component Repository, ensuring that your plugins behave as expected and interact correctly with the repository.