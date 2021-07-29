# ds-tna-wp-aws
AWS WordPress Plugin

## Development setup

### Composer dependency management

Composer is used for dependency management, initially for PHPUnit but extending to other dependencies as needed.

#### Installing Composer

To [download and install Composer](https://getcomposer.org/download/) follow the documentation.

At this stage you should be able to execute the ```composer``` command in the Terminal to see all the available options.

#### Obtaining dependencies via Composer

Having followed the steps above you will be able to install dependencies by typing ```composer install``` at the Terminal within the plugin directory.

### PHPUnit

Having followed the steps about type ```./vendor/bin/phpunit tests``` at the Terminal within the plugin directory to run [PHPUnit](https://phpunit.de/getting-started/phpunit-9.html) Unit Tests for the project.

Note: PhpStorm allows for PHPUnit integration - allowing your tests to be run automatically. Search the JetBrains website to find out how to configure this.
