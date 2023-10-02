# Using `bootstrap.php` for ILIAS Plugin Testing

This README provides instructions on how to effectively set up and streamline your ILIAS plugin testing using the provided bootstrap file. 
Ensuring that your plugin tests can find all ILIAS-related classes and operate seamlessly requires two essential steps: 
including the ILIAS autoloader and changing the working directory to the ILIAS root. 
This is necessary because some file includes are defined as relative paths inside the ILIAS core project.

## Usage

Follow these steps to leverage the packaged `bootstrap.php` for your ILIAS plugin testing:

1. Locate the `phpunit.xml` file in your plugin's root directory.

2. Customize the `phpunit.xml` file by adding the following line, specifying the path to the `bootstrap.php` file in your plugin's vendor directory:

```xml
<phpunit bootstrap="vendor/thojou/ilias-plugin-utils/src/Test/bootstrap.php">
    <!-- your other settings -->
</phpunit>
```

By integrating the provided `bootstrap.php`, you'll seamlessly configure your ILIAS plugin testing environment, making it easier to locate ILIAS-related classes and ensure your tests work flawlessly.