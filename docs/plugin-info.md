# Using the `PluginInfo` Class Inside Your `plugin.php` for ILIAS Plugin

The `PluginInfo` class streamlines the management and retrieval of metadata information from a `composer.json` file,
simplifying ILIAS plugin development.
This class allows you to define essential plugin metadata within the `composer.json` file,
making it more convenient to maintain and update this information as needed.

## Table of Contents
1. [Introduction](#1-introduction)
2. [Updating `composer.json`](#2-updating-composerjson)
3. [Usage: `plugin.php`](#3-usage-pluginphp)

## 1. Introduction

When creating plugins for ILIAS, it's crucial to provide metadata information about your plugin, such as its ID, version, and compatibility with various ILIAS versions.
Traditionally, this metadata is stored in the `plugin.php` file. However, with the increasing adoption of Composer as a package manager in the ILIAS community, you could now conveniently store this information in the `composer.json` file.
The `PluginInfo` class is specifically designed to be utilized within your `plugin.php` file in ILIAS plugins.
It simplifies the process of extracting metadata information from the `composer.json` file,
reducing the need to update both `plugin.php` and `composer.json` separately.

## 2. Updating `composer.json`

To start leveraging the `PluginInfo` class, ensure that your `composer.json` file contains the necessary metadata.
Therefor you can copy the existing information from your `plugin.php` file and paste it into the `composer.json` file.

```json
{
    "authors": [
        {
            "name": "Your Name",
            "email": "your.email@example.com"
        }
    ],
    "extra": {
        "ilias-plugin": {
            "id": "your-plugin-id",
            "version": "1.0.0",
            "min_version": "5.4.0",
            "max_version": "6.0.0"
        }
    }
}
```

## 3. Usage: `plugin.php`

To use the `PluginInfo` class in your `plugin.php` file, replace the content of the plugin.php with the following informations:

```php
<?php

declare(strict_types=1);

use Thojou\ILIAS\Plugin\Utils\Info\PluginInfo;

$pluginInfo = PluginInfo::resolve(__DIR__ . '/composer.json');
extract($pluginInfo);
```

Now all required variables are defined inside the `plugin.php` file.

By following these guidelines and using the `PluginInfo` class within your `plugin.php` file, you can efficiently manage and access essential plugin metadata during ILIAS plugin development. This approach simplifies the maintenance of plugin information, as changes can be made directly in the `composer.json` file.