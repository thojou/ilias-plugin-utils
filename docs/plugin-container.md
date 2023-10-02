# Using the `PluginContainer` Class for Dependency Injection in ILIAS Plugin

The `PluginContainer` class facilitates dependency injection in ILIAS by providing a centralized container for managing services and dependencies related to an ILIAS plugin.
This class aims to improve code organization and maintainability by reducing the reliance on global variables, specifically the `global $DIC` keyword.
By using the `PluginContainer` class, you can ensure that global keywords are only used in one central location within your plugin, promoting cleaner and more maintainable code.

Additionally, the `PluginContainer` class offers the advantage of distinguishing between plugin-specific services and core services.
All services registered using the `register` method are associated with the plugin's ID within the container. 
This prevents collisions with services from other plugins or core modules. 
Furthermore, it allows you to access services using the fully qualified class name (FQN) instead of an alias, simplifying service retrieval as developers no longer need to remember the alias-to-class relationships.

## Table of Contents
1. [Introduction](#1-introduction)
2. [Getting Started](#2-getting-started)
3. [Accessing the Core Container](#3-accessing-the-core-container)
4. [Registering and Retrieving Services](#4-registering-and-retrieving-services)

## 1. Introduction

When developing plugins for ILIAS, managing dependencies and services is essential for maintaining a clean and organized codebase. 
The use of global keywords like `global $DIC` can lead to unintended side effects and is generally considered poor programming practice. 
The `PluginContainer` class provides a solution to this problem by centralizing access to the DI (Dependency Injection) container.

This documentation will guide you on how to effectively utilize the `PluginContainer` class in your ILIAS plugin development.

## 2. Getting Started

In your plugin's codebase, you need to initialize the `PluginContainer` once. 
Typically, this is done during plugin initialization. Here's how to do it:

```php

use Thojou\ILIAS\Plugin\Utils\Container\PluginContainer;

class YourPlugin extends \ilPlugin
{
    const PLUGIN_ID = 'your_plugin_id';
    private static bool $initialized = false;

    public function init()
    {
        if(self::$initialized) {
            return;
        }
    
        global $DIC; // This is the only place where you need to use the global keyword.
        
        $pluginContainer = PluginContainer::init($DIC, self::PLUGIN_ID);
        
        // Register your services here.
    }
}
```

With this initialization, you have a singleton instance of the `PluginContainer` class that you can use throughout your plugin.

## 3. Accessing the Core Container

You can easily access the core DI container within your plugin using the `core` method of the `PluginContainer` class.
This allows you to retrieve core services and perform operations related to dependency injection:

```php
$ilLanguage = PluginContainer::get()->core()->language(); // Retrieves the ILIAS language service.
```

## 4. Registering and Retrieving Services

The `PluginContainer` class simplifies the registration and retrieval of services within your plugin. 
You can use it to avoid naming conflicts with services from other plugins or core modules.
Here's how to register and retrieve services:

### 4.1. Registering a Service

To register a service in the container, use the `register` method. 
Provide a unique key for the service within your plugin and a callable function that defines how the service should be created:

```php
$pluginContainer->register(YourService::class, fn (Container $container) => new YourService($container['lng']));
```

### 4.2. Retrieving a Service

To retrieve a registered service from the container, use the `getService` method. Provide the key that you used during registration:

```php
$service = PluginContainer::get()->getService(YourService::class);
```

If the service is not found or if it's not an object, an exception will be thrown, ensuring that you handle service retrieval errors gracefully.

By following these guidelines and using the `PluginContainer` class within your ILIAS plugin, you can promote clean and maintainable code by reducing the use of the `global` keyword.
Additionally, you can organize your services efficiently and avoid naming conflicts with other plugins or core modules.
This approach enhances the overall development experience and ensures better code quality in your ILIAS plugins.