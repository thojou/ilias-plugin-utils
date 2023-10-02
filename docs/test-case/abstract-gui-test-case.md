# Using the `AbstractGUITestCase` Class for Testing ILIAS GUI Classes

The `AbstractGUITestCase` class simplifies the testing of ILIAS plugin GUI classes by providing common methods and utilities. It extends PHPUnit's `TestCase` class and includes traits for container mocking and common testing helpers. Before delving into the class details, let's first understand what GUI classes in ILIAS are.

## What Are GUI Classes in ILIAS?

In ILIAS, GUI (Graphical User Interface) classes are responsible for handling the presentation and interaction aspects of the application. These classes typically contain logic related to rendering HTML templates, processing user inputs, and managing the user interface. GUI classes in ILIAS can be thought of as "controllers" in the Model-View-Controller (MVC) architecture, where they orchestrate the flow of data between the model and the view.

## AbstractGUITestCase Overview

The `AbstractGUITestCase` class is designed to streamline the testing of ILIAS plugin GUIs, which are often responsible for a wide range of scenarios and interactions. This abstract test case class provides the following key features and utilities:

* **Container Mocking**: It includes the `ContainerMockHelperTrait`, allowing you to mock and manage services within the ILIAS Dependency Injection (DI) Container.
* **Common Testing Helpers**: It includes the `CommonHelperTrait`, which provides common helper methods and properties for testing ILIAS plugin GUIs. These methods are useful for tasks such as registering and mocking ILIAS core services and components.
* **Template Content Expectation**: The `expectTplContent` method allows you to set expectations for the template content to ensure that it matches the expected output.
* **Command Mocking**: The `mockCommand` method enables you to mock a command by configuring the control object to return the specified command.
* **Redirect Expectation**: The `expectRedirect` method allows you to set expectations for a redirect operation. You can specify the expected invocation order and the target method for redirection.
* **Mocking HTTP Requests**: The `mockPostRequest` and `mockGetRequest` methods facilitate the mocking of HTTP requests, including POST and GET requests, with optional query parameters.

By utilizing these features and utilities, you can effectively test ILIAS plugin GUIs while reducing the complexity and repetition often associated with GUI testing.

## Using `AbstractGUITestCase`

To use the `AbstractGUITestCase` class for testing your ILIAS plugin GUIs, create a test class that extends it, as demonstrated in the example below:

```php
use Thojou\Ilias\Plugin\Utils\Test\TestCase\AbstractGUITestCase;
use Thojou\Ilias\Plugin\Utils\Test\Traits\PageComponentHelperTrait;

class YourPluginGUITest extends AbstractGUITestCase
{
    use PageComponentHelperTrait;
    
    protected function setUp(): void
    {
        $this->setupGUICommons();
        $this->registerPCPluggedGUI();
        
        // Register plugin services if needed
        // $DIC = $this
        //    ->mockPluginService(YourService::class, $this->createMock(YourService::class))
        //    ->getDICMock();
        
        // Initialize plugin container if used
        //PluginContainer::init($DIC, ilCoSourceCodePlugin::PLUGIN_ID);
    }
    
    /**
    * Test the create command for a new page component.
    */
    public function testCreate(): void
    {
        $properties = [
            'title' => 'Hello',
            'content' => 'World',
        ];

        $this->mockCommand('create');
        $this->mockPostRequest($properties);
        $this->expectPCGUICreate($this->equalTo($properties));
        $this->expectTplContent($this->logicalAnd(
            $this->stringContains('title'),
            $this->stringContains('Hello'),
            $this->stringContains('content'),
            $this->stringContains('World'),
        ));

        $this->executePageComponentGUI(new ilYourPluginGUI(), ilYourPlugin::class);
    }
    
    protected function getPluginId(): string
    {
        return ilYourPlugin::PLUGIN_ID;
    }
}
```

Extending `AbstractGUITestCase` provides your test class with the functionality and utilities needed to simplify the testing of ILIAS plugin GUIs.

By following these guidelines and using the `AbstractGUITestCase` class, you can improve the efficiency and quality of your ILIAS plugin GUI testing while minimizing repetition and complexity in your test setup.