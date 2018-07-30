<?php

namespace XerviceTest\Core\Locator;

use Test\Core\CoreFacade;
use Xervice\Core\Client\EmptyClient;
use Xervice\Core\CoreClient;
use Xervice\Core\CoreFactory;
use Xervice\Core\Facade\EmptyFacade;
use Xervice\Core\Factory\EmptyFactory;
use XerviceTest\Core\Locator\TestInjector\TestProxy;

require_once __DIR__ . '/TestInjector/CoreFactory.php';

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     */
    public function testLocatorGetFacade()
    {
        $this->assertInstanceOf(
            CoreFacade::class,
            $this->tester->getLocator()->core()->facade()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     */
    public function testLocatorGetFactory()
    {
        $this->assertInstanceOf(
            CoreFactory::class,
            $this->tester->getLocator()->core()->factory()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     */
    public function testLocatorGetClient()
    {
        $this->assertInstanceOf(
            CoreClient::class,
            $this->tester->getLocator()->core()->client()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     * @group Fail
     */
    public function testLocatorGetFactoryProxy()
    {
        $this->assertInstanceOf(
            TestProxy::class,
            $this->tester->getLocator()->notexist()
        );

        $this->assertEquals(
            'MyTest',
            $this->tester->getLocator()->notexist()->testing()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     * @group Fail
     */
    public function testLocatorGetFacadeException()
    {
        $this->assertInstanceOf(
            EmptyFacade::class,
            $this->tester->getLocator()->notexist()->facade()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     * @group Fail
     */
    public function testLocatorGetFactoryException()
    {
        $this->assertInstanceOf(
            EmptyFactory::class,
            $this->tester->getLocator()->notexist()->factory()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     * @group Fail
     */
    public function testLocatorGetClientException()
    {
        $this->assertInstanceOf(
            EmptyClient::class,
            $this->tester->getLocator()->notexist()->client()
        );
    }
}