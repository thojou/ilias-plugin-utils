# ILIAS Plugin Utils

![Static Badge](https://img.shields.io/badge/PHP_Version-%3E%3D7.4-blue)
[![License](https://img.shields.io/github/license/thojou/ilias-plugin-utils)](./LICENSE)
[![CI](https://github.com/thojou/ilias-plugin-utils/actions/workflows/ci.yaml/badge.svg)](https://github.com/thojou/ilias-plugin-utils/actions/workflows/ci.yaml)
![Coverage](https://img.shields.io/badge/coverage-100%25-green)
![PHPStan](https://img.shields.io/badge/PHPStan-level%209-brightgreen.svg?style=flat)

## Introduction

The "ILIAS Plugin Utils" library is a collection of utility classes and traits designed to simplify the development and testing of ILIAS (Integriertes Lern-, Informations- und Arbeitskooperationssystem) plugins. 
It provides various helper methods and traits to streamline common tasks when building and testing ILIAS plugins.

## Requirements

Before using this library, make sure you meet the following requirements:

- PHP >= 7.4
- ILIAS >= 8.0

## Installation

To install the "ILIAS Plugin Utils" library, you can use Composer. Run the following command in your plugin's root directory:

```bash
composer require thojou/ilias-plugin-utils
```

## Usage

The library offers several traits and classes that you can use to simplify plugin development and testing in ILIAS. 
You can include these traits in your plugin classes to leverage their functionality. 
See the [docs](./docs) directory for detailed usage guideline.

**Dependency Injection**
* [PluginContainer](./docs/plugin-container.md): Helps manage dependencies and services for your plugin.

**Info**
* [PluginInfo](./docs/plugin-info.md): Extracts essential information from your plugin's composer.json file.

**Test Bootstrap**
* [bootstrap.php](./docs/bootstrap.md): A bootstrap file for setting up the test environment.


**Test Cases**
* [AbstractGUITestCase](./docs/test-case/abstract-gui-test-case.md): A base test case class for GUI-related tests.
* [AbstractPluginTestCase](./docs/test-case/abstract-plugin-test-case.md): A base test case class for plugin-related tests.

**Test Traits**
* [ContainerMockHelperTrait](./docs/traits/container-mock-helper-trait.md): Provides methods for mocking Services inside the ILIAS DI Container.
* [ConfigGUIHelperTrait](./docs/traits/config-gui-helper-trait.md): Provides methods for testing ILIAS configuration GUI commands.
* [CommonHelperTrait](./docs/traits/common-helper-trait.md): Provides helper methods for common ILIAS services and components.
* [PageComponentHelperTrait](./docs/traits/page-component-helper-trait.md): Helps with testing ILIAS page component plugins.
* [PluginHelperTrait](./docs/traits/plugin-helper-trait.md): Aids in testing ILIAS plugins that interact with the Component Repository.

