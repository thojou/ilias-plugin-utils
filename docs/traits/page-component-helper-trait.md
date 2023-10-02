# Using the `PageComponentHelperTrait` for Testing ILIAS Page Component Plugin

The `PageComponentHelperTrait` is a testing utility trait designed to simplify the testing of ILIAS page component plugins. It provides helper methods for registering and managing mocked page component plugins and GUIs, as well as setting expectations for their methods. This trait is particularly useful when testing ILIAS plugins that involve page components.

## Table of Contents
1. [Introduction](#1-introduction)
2. [Getting Started](#2-getting-started)
3. [Registering and Managing Page Component Plugins](#3-registering-and-managing-page-component-plugins)
4. [Setting Expectations](#4-setting-expectations)

## 1. Introduction

Testing ILIAS page component plugins often requires interactions with page components and their associated GUIs. 
Manually managing and setting up mocks for these components can be complex and time-consuming. The `PageComponentHelperTrait` streamlines this process by providing methods for registering, managing, and setting expectations for page component plugins and GUIs.

## 2. Getting Started

To get started with the `PageComponentHelperTrait`, include it in your test class. Here's an example of how to use it:

```php
use Thojou\Ilias\Plugin\Utils\Test\Traits\PageComponentHelperTrait;

class YourPageComponentPluginTest extends PHPUnit\Framework\TestCase
{
    use PageComponentHelperTrait;
    
    // Your test methods go here.
}
```

By including the trait in your test class, you gain access to its helper methods.

## 3. Registering and Managing Page Component Plugins

The `PageComponentHelperTrait` provides methods for registering and managing mocked page component plugins and GUIs. These methods allow you to prepare your test environment for page component testing.

### 3.1. Registering a Mocked Page Component GUI

To register a mocked page component GUI with optional properties, use the `registerPCPluggedGUI` method:

```php
$pcGUI = $this->registerPCPluggedGUI(['property' => 'value']);
```

This method returns the registered mocked page component plugin GUI and allows you to set properties for the page content mock object.

## 4. Setting Expectations

The `PageComponentHelperTrait` allows you to set expectations for specific page component GUI commands, such as creating or updating elements. This is useful for testing the behavior of your page component plugins.

### 4.1. Setting Expectations for Creating Elements

To set an expectation for creating a page component GUI element, use the `expectPCGUICreate` method:

```php
$this->expectPCGUICreate($expectedConstraint, $willSucceed = true);
```

This method sets an expectation for the creation of a page component GUI element and specifies whether the expectation should succeed.

### 4.2. Setting Expectations for Updating Elements

To set an expectation for updating a page component GUI element, use the `expectPCGUIUpdate` method:

```php
$this->expectPCGUIUpdate($expectedConstraint, $willSucceed = true);
```

This method sets an expectation for updating a page component GUI element and specifies whether the expectation should succeed.

By following these guidelines and using the `PageComponentHelperTrait`, you can simplify the testing of ILIAS page component plugins, ensuring that your plugins function correctly and behave as expected under various conditions.