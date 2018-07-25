Xervice: Core
====

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/core/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/core/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/core/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/core/?branch=master)

Core classes for Xervice services


Installation
===================
```
composer require xervice/core
```


Configuration
--------------------
You need no configuration to use this package.
But you can define your application namespaces.

***Main Projectnamespace***
```php
use Xervice\Core\CoreConfig;

$config[CoreConfig::PROJECT_LAYER_NAMESPACE] = 'MyPackageNamespace'; // Default is "App"
```

***Additional Namespace layers***
```php
use Xervice\Core\CoreConfig;

$config[CoreConfig::ADDITIONAL_LAYER_NAMESPACES] = [
    'SpecificLayer'
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
                * [ my business layer]
            * Communication
                * [ my communication layer ]
            * Persistence
                * [ my persistence layer ]
            * MyModuleClient.php
            * MyModuleConfig.php
            * MyModuleDependencyProvider.php
            * MyModuleFacade.php
            * MyModuleFactory.php

If you don't need one of these classes, you can remove them.

To use your Module you can use the core locator in your application:
```php
<?php

$locator = \Xervice\Core\Locator\Locator::getInstance();

$locator->myModule()->client();
$locator->myModule()->factory();
$locator->myModule()->facade();
```

Your should not use the config and dependency-provider in an external scope. It's only for using inside your module.


Facade
---------
The Facade is your interface for external usage. In that class you define your public methods, that you want to open for other modules.

***Example***
```php
<?php


namespace Ap\MyModule;


use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \App\MyModule\MyModuleFactory getFactory()
 */
class MyModuleFacade extends AbstractFacade
{
    /**
     * @return string
     */
    public function getMyModuleData(): string
    {
        return $this->getFactory()->createBusinessClass()->getModuleData();
    }
}
```

You should not have any business logic in your facade. It's only for providing your functions and use your factory to use your business classes.


Config
--------
In your config you can access values from the XerviceConfig package.

***Example***
```php
<?php

namespace App\MyModule;

use Xervice\Core\Config\AbstractConfig;

class MyModuleConfig extends AbstractConfig
{
    public const KEY_FOR_CONFIG = 'key.for.config';

    /**
     * @return string
     */
    public function getValueFromConfig(): string
    {
        return $this->get(self::KEY_FOR_CONFIG, 'myDefaultValue');
    }
}
```

In your xervice config file you can change the value:
```php

$config[\App\MyModule\MyModuleConfig::KEY_FOR_CONFIG] = 'newValue';
```


Factory
-----------
You should instantiate all objects in your factory. Every dependency is provided by the factory to your object.
Here you can access your config class to provide them to your business logic.

***Example***
```php
<?php

namespace App\MyModule;

use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \App\MyModule\MyModuleConfig getConfig()
 */
class MyModuleFactory extends AbstractFactory
{
    /**
     * @return MyBusinessClassInterface
     */
    public function createBusinessClass(): MyBusinessClassInterface
    {
        return new MyBusinessClass(
            $this->createOneDependency(),
            $this->getConfig()->getValueFromConfig()
        );
    }

    /**
     * @return OtherBusinessClassInterface
     */
    public function createOneDependency(): OtherBusinessClassInterface
    {
        return new OtherBusinessClass();
    }
}
```


DependencyProvider
----------------------

The dependency-Provider is the way to open your module for extending from the outside and to get facades from other modules.

***Example***
```php
<?php

namespace App\MyModule;

use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

class MyModuleDependencyProvider extends AbstractProvider
{
    public const OTHER_MODULE_FACADE = 'other.module.facade';
    public const PLUGIN_LIST = 'plugin.list';

    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::OTHER_MODULE_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->otherModule()->facade();
        };

        $dependencyProvider[self::PLUGIN_LIST] = function () {
            return $this->getPluginList();
        };
    }

    /**
     * @return \App\MyModule\Business\Plugin\MyPluginInterface[]
     */
    protected function getPluginList(): array
    {
        return [];
    }
}
```

In that example you can use the dependencies in your factory this way:
```php
<?php

namespace App\MyModule;

use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \App\MyModule\MyModuleConfig getConfig()
 */
class MyModuleFactory extends AbstractFactory
{
    /**
     * @return OtherModuleFacade
     */
    public function getOtherModuleFacade(): OtherModuleFacade
    {
        return $this->getDependency(MyModuleDependencyProvider::OTHER_MODULE_FACADE);
    }

    /**
     * @return \App\MyModule\Business\Plugin\MyPluginInterface[]
     */
    public function getPluginList(): array
    {
        return $this->getDependency(MyModuleDependencyProvider::PLUGIN_LIST);
    }
}
```

Then you can use that methods as a dependency in other object instantiations. This way you can access the functionality from other modules without direct usage of that classes.


Client
-----------
The client is similar to your facade. But in the client you provide functions to access external systems like a database or external api via your module.
The class structure is identicaly to your Facade class.


Auto generating
--------------------
To generate a module you can use the xervicecli package:
```
composer global require xervice/xervicecli
```

***Using***
```
xervice xervice:create:service MyModule MyNamespace
```

That will create a new Module "MyModule" in the current directory.