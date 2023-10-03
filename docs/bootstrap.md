# Using `bootstrap.php` for ILIAS Plugin Testing

This README provides instructions on how to effectively set up and streamline your ILIAS plugin testing using a bootstrap file. 
Ensuring that your plugin tests can find all ILIAS-related classes and operate seamlessly requires two essential steps: 
including the ILIAS autoloader and changing the working directory to the ILIAS root. 
This is necessary because some file includes are defined as relative paths inside the ILIAS core project.

## Usage

1. Create a `bootstrap.php` inside you plugin's `tests` directory.

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Thojou\Ilias\Plugin\Utils\Info\IliasRootDetector;

$ILIAS_ROOT = IliasRootDetector::find(__DIR__);

if(file_exists($ILIAS_ROOT . '/libs/composer/vendor/autoload.php')) {
    require_once $ILIAS_ROOT . '/libs/composer/vendor/autoload.php';
}

chdir($ILIAS_ROOT);
```

2. Locate the `phpunit.xml` file in your plugin's root directory.
3. Customize the `phpunit.xml` file by adding the following line, specifying the path to the `bootstrap.php` file in your plugin's tests directory:

```xml
<phpunit bootstrap="tests/bootstrap.php">
    <!-- your other settings -->
</phpunit>
```

By integrating a `bootstrap.php` as described, you'll seamlessly configure your ILIAS plugin testing environment, making it easier to locate ILIAS-related classes and ensure your tests work flawlessly.