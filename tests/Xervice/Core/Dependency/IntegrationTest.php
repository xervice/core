<?php

namespace XerviceTest\Core\Dependency;

use Xervice\Config\Container\ConfigContainer;
use Xervice\Core\Dependency\DependencyProvider;
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
        $provider = new DependencyProvider();
        $provider->set(
            "test", function () {
            return "testings";
        }
        );

        $this->assertEquals(
            "testings",
            $provider->get("test")
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
        $container = new DependencyProvider();

        $provider = $this->getMockBuilder(AbstractProvider::class)
                         ->setMethods(["handleDependencies"])
                         ->disableOriginalConstructor()
                         ->getMock();

        $provider->expects($this->once())
                 ->method("handleDependencies")
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
    public function testGetConfigWorks()
    {
        $container = new DependencyProvider();

        $this->assertInstanceOf(
            ConfigContainer::class,
            $container->getConfig()
        );
    }
}