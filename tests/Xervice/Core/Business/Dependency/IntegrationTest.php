<?php
namespace XerviceTest\Core\Business\Dependency;

use Xervice\Core\Business\Model\Config\AbstractConfig;
use Xervice\Core\Business\Model\Dependency\AbstractDependencyContainer;

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
            new AbstractConfig()
        );

        $container->set('TEST', 'BEFORE');

        $this->assertEquals(
            'BEFORE',
            $container->get('TEST')
        );

        $container->register(
            new DependencyProvider(new AbstractConfig())
        );

        $this->assertEquals(
            'TESTING',
            $container->get('TEST')
        );

        $container['TEST'] = 'AFTER';

        $this->assertEquals(
            'AFTER',
            $container['TEST']
        );
    }
}