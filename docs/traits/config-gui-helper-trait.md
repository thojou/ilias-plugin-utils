# Using the `ConfigGUIHelperTrait` for Testing ILIAS Plugin Configuration GUI

The `ConfigGUIHelperTrait` is a testing utility trait designed to simplify the testing of ILIAS plugins with configuration GUIs.
It provides helper methods for performing commands on ILIAS plugin configuration GUI classes, making it easier to test various configurations and scenarios.

## Table of Contents
1. [Introduction](#1-introduction)
2. [Getting Started](#2-getting-started)
3. [Performing Commands](#3-performing-commands)

## 1. Introduction

Testing ILIAS plugins often involves working with configuration GUIs to ensure that they function correctly under different scenarios. 
Manually testing these configurations can be time-consuming and error-prone. The `ConfigGUIHelperTrait` aims to simplify this process by providing methods to perform commands on ILIAS plugin configuration GUI objects.

## 2. Getting Started

To get started with the `ConfigGUIHelperTrait`, include it in your test class. Here's an example of how to use it:

```php
use Thojou\Ilias\Plugin\Utils\Test\Traits\ConfigGUIHelperTrait;

class YourPluginConfigTest extends PHPUnit\Framework\TestCase
{
    use ConfigGUIHelperTrait;
    
    // Your test methods go here.
}
```

By including the trait in your test class, you gain access to its helper methods.

## 3. Performing Commands

The `ConfigGUIHelperTrait` offers a single method, `performConfigGUICommand`, for performing commands on ILIAS plugin configuration GUI objects.

### 3.1. Performing a Command

To perform a command on an ILIAS plugin configuration GUI, use the `performConfigGUICommand` method. You need to specify the name of the command to execute, the instance of the ILIAS plugin configuration GUI, and the class name of the ILIAS plugin object:

```php
$this->performConfigGUICommand('your_command_name', $guiInstance, YourPlugin::class);
```

This method sets up the plugin object, executes the specified command on the GUI, and allows you to test different command scenarios.

By following these guidelines and using the `ConfigGUIHelperTrait`, you can simplify the testing of ILIAS plugins with configuration GUIs, 
ensuring that your configurations are correct and functional under various conditions.