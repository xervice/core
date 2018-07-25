<?php

namespace XerviceTest\Core\Dependency\Provider;

use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

class TestProvider extends AbstractProvider
{
    public const TEST_VALUE = 'test.value';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::TEST_VALUE] = function () {
            return 'TestValue';
        };
    }

}