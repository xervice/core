<?php

namespace XerviceTest\Core\Business\Dependency;

use Xervice\Core\Business\Model\Config\AbstractConfig;
use Xervice\Core\Business\Model\Dependency\AbstractDependencyContainer;
use Xervice\Core\Business\Model\Locator\Locator;

class IntegrationTest extends \Codeception\Test\Unit
{

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Dependency
     */
    public function testDependencyProvider()
    {
        $container = new AbstractDependencyContainer(
            new AbstractConfig(),
            Locator::getInstance()->core()
        );

        $container->set(
            'TEST',
            function () {
                return 'BEFORE';
            }
        );

        $this->assertEquals(
            'BEFORE',
            $container->get('TEST')
        );

        $container->register(
            new DependencyProvider(
                new AbstractConfig(),
                Locator::getInstance()->core()
            )
        );

        $this->assertEquals(
            'TESTING',
            $container->get('TEST')
        );

        $container->extend(
            'TEST',
            function (string $oldValue) {
                return $oldValue . 'AFTER';
            }
        );

        $this->assertEquals(
            'TESTINGAFTER',
            $container['TEST']
        );
    }
}