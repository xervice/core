<?php

namespace XerviceTest\Core\Dependency;

use Xervice\Config\Container\ConfigContainer;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\CoreConfig;
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
        $provider = new DependencyProvider(new CoreConfig());
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
        $container = new DependencyProvider(new CoreConfig());

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
        $container = new DependencyProvider(new CoreConfig());

        $this->assertInstanceOf(
            CoreConfig::class,
            $container->getConfig()
        );
    }
}