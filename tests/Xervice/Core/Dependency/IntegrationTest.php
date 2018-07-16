<?php

namespace XerviceTest\Core\Dependency;

use Xervice\Config\Container\ConfigContainer;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\CoreConfig;
use Xervice\Core\Dependency\DependencyProvider;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;

    /**
     * @group Xervice
     * @group Core
     * @group Dependency
     * @group Integration
     */
    public function testDependencyProviderSetAndGet()
    {
        $provider = new DependencyProvider(new CoreConfig());
        $provider->set(
            'test',
            function () {
                return 'testings';
            }
        );

        $provider['test2'] = function () {
            return 'testing2';
        };

        $this->assertEquals(
            'testings',
            $provider->get('test')
        );

        $this->assertEquals(
            'testing2',
            $provider->get('test2')
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Dependency
     * @group Integration
     */
    public function testDependencyProviderRegisterProvider()
    {
        $container = new DependencyProvider(new CoreConfig());

        $provider = $this->getMockBuilder(AbstractProvider::class)
                         ->setMethods(['handleDependencies'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $provider->expects($this->once())
                 ->method('handleDependencies')
                 ->with($this->equalTo($container))
                 ->willReturn($container);

        $container->register($provider);
    }

    /**
     * @group Xervice
     * @group Core
     * @group Dependency
     * @group Integration
     */
    public function testSetAndGetDependency()
    {
        $container = new DependencyProvider(new CoreConfig());

        $container->set('myTestWithoutArgument', function () {
            return 'myTestWithoutArgument';
        });

        $container->set('myTestWithArgument', function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->get('myTestWithoutArgument') . '--WithParam';
        });

        $this->assertEquals(
            'myTestWithoutArgument',
            $container->get('myTestWithoutArgument')
        );

        $this->assertEquals(
            'myTestWithoutArgument--WithParam',
            $container->get('myTestWithArgument')
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Dependency
     * @group Integration
     */
    public function testGetConfigWorks()
    {
        $container = new DependencyProvider(new CoreConfig());

        $this->assertInstanceOf(
            CoreConfig::class,
            $container->getConfig()
        );
    }
}