# Using the `CommonHelperTrait` for ILIAS Plugin Testing

The `CommonHelperTrait` is a testing utility trait that simplifies the testing of ILIAS plugins by providing helper methods for registering and mocking various ILIAS core services and components. It is designed to streamline the process of setting up common services and components used during plugin testing, reducing the complexity of your test code.

## Table of Contents
1. [Introduction](#1-introduction)
2. [Getting Started](#2-getting-started)
3. [Registering and Mocking Services](#3-registering-and-mocking-services)

## 1. Introduction

When testing ILIAS plugins, you often need to work with various ILIAS core services and components. 
Manually setting up and mocking these services can be cumbersome and error-prone.
The `CommonHelperTrait` is a handy tool that provides predefined methods for registering and mocking essential ILIAS services,
such as the template engine, language service, and more.

> **Note:** The `CommonHelperTrait` is already used inside `AbstractGUITestCase` and `AbstractPluginTestCase` classes.

## 2. Getting Started

To get started with the `CommonHelperTrait`, you should include it in your test class. Here's an example of how to use it:

```php
use Thojou\Ilias\Plugin\Utils\Test\Traits\CommonHelperTrait;

class YourPluginTest extends PHPUnit\Framework\TestCase
{
    use CommonHelperTrait;
    
    // Your test methods go here.
}
```

By including the trait in your test class, you gain access to its helper methods.

## 3. Registering and Mocking Services

The `CommonHelperTrait` offers a set of methods for registering and mocking various ILIAS core services and components. 
These methods make it easier to set up the necessary dependencies for your plugin testing.

### 3.1. Registering and Mocking the Refinery Service

To register the Refinery service, use the `registerRefinery` method:

```php
$refinery = $this->registerRefinery();
```

This method returns the registered Refinery instance. Because the Refinery service does not have any external dependencies, 
it does not need to be mocked.

### 3.2. Registering and Mocking the Language Service

To register and mock the language service, use the `registerLanguage` method:

```php
$language = $this->registerLanguage();
```

This method returns the registered and mocked language object.

### 3.3. Registering and Mocking the Global Template Object

To register and mock the global template object, use the `registerTemplate` method:

```php
$template = $this->registerTemplate();
```

This method returns the registered and mocked global template object.

### 3.4. Registering and Mocking the Control Object

To register and mock the control object, use the `registerCtrl` method:

```php
$ctrl = $this->registerCtrl();
```

This method returns the registered and mocked control object.

### 3.5. Registering and Mocking the Component Factory

To register and mock the component factory object, use the `registerComponentFactory` method:

```php
$componentFactory = $this->registerComponentFactory();
```

This method returns the registered and mocked component factory object.

### 3.6. Registering and Mocking the HTTP Service

To register and mock the HTTP service object, use the `registerHttp` method:

```php
$http = $this->registerHttp();
```

This method returns the registered and mocked HTTP service object.

### 3.7. Registering and Mocking the Style Definition Object

To register and mock the style definition object, use the `registerStyleDefinition` method:

```php
$styleDefinition = $this->registerStyleDefinition();
```

This method returns the registered and mocked style definition object.

### 3.8. Registering and Mocking the User Object

To register and mock the user object, use the `registerUser` method:

```php
$user = $this->registerUser();
```

This method returns the registered and mocked user object.

### 3.9. Setting up Common Components for GUI Tests

For GUI tests, you can set up common components and services using the `setupGUICommons` method. 
This method registers and mocks all previous named services. It's a convenient way to prepare your test environment:

```php
$this->setupGUICommons();
```

By following these guidelines and using the `CommonHelperTrait`, you can streamline the process of setting up and mocking 
essential ILIAS services and components for your plugin testing, making your tests more efficient and maintainable.