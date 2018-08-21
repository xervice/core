Xervice: Core
====

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/core/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/core/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/core/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/core/?branch=master)
[![Build Status](https://travis-ci.org/xervice/core.svg?branch=master)](https://travis-ci.org/xervice/core)

Core classes for Xervice services


Installation
===================
```
composer require xervice/core
```


Configuration
--------------------
You need no configuration to use this package.
But you can define the namespaces.

***Main Projectnamespace***
```php
use Xervice\Core\CoreConfig;

$config[CoreConfig::CORE_NAMESPACES] = [
    'Xervice'
];

$config[CoreConfig::PROJECT_NAMESPACES] = [
    'App'
];
```

Usage
-------------

You can create your own Xervice packages. For that you have to use a project namespace and create a module directory.
In that directory you can use some predefined patterns like Facade, Factory, DependencyProvider, Config and Client.

***Structure***
.
* src
    * MyNamespace
        * MyModule
            * Business
                * MyModuleFacade.php
                * MyModuleBusinessFactory.php
            * Communication
                * MyModuleCommunicationFactory.php
                * MyModuleDependencyProvider.php (For the communication layer)
            * Persistence
                * MyModuleReader.php
                * MyModuleWriter.php
            * MyModuleConfig.php
            * MyModuleDependencyProvider.php (For the business layer)

If you don't need one of these classes, you can remove them.

To use your Module you can use the core locator in your application:
```php
<?php

$locator = \Xervice\Core\Locator\Locator::getInstance();

$locator->myModule()->facade()->publicMethod();
```

Dynamic Locator
--------------------

There are two dynamic locator traits:
* DynamicBusinessLocator
* DynamicCommunicationLocator


Layer
---------
Communication -> Business -> Persistence


1. In the communication layer you can access the communication factory
2. In the communication layer you can access the facade from your BusinessLayer.
3. In the BusinessLayer facade you can access the business factory
4. In the business factory you can access the reader and writer from the persistence layer

Business and communication have their own dependency container. You can access them from the factory.




Extending
-----------
To extend a module, you can create a directory with the same name in an upper level namespace. The order of the namespaces is:
1. Core-Namespaces in defined order (Default: Xervice)
2. Project namespace in defined order (Default: App)

If you have an module in the Xervice namespace, you can overwrite the classes in your Projectnamespaces.
And that logic you can also extend in lower projectnamespaces.



Auto generating
--------------------
To generate a module you can use the [xervicecli](https://github.com/xervice/xervicecli) package.