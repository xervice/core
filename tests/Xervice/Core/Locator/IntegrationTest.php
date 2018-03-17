<?php

namespace XerviceTest\Core\Locator;

use Test\Core\CoreFacade;
use Xervice\Core\CoreClient;
use Xervice\Core\CoreFactory;

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
     *
     * @expectedException \Xervice\Core\Locator\Exception\LocatorFacadeNotFound
     */
    public function testLocatorGetFacadeException()
    {
        $this->tester->getLocator()->notexist()->facade();
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     * @group Fail
     *
     * @expectedException \Xervice\Core\Locator\Exception\LocatorFactoryNotFound
     */
    public function testLocatorGetFactoryException()
    {
        $this->tester->getLocator()->notexist()->factory();
    }

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Integration
     * @group Fail
     *
     * @expectedException \Xervice\Core\Locator\Exception\LocatorClientNotFound
     */
    public function testLocatorGetClientException()
    {
        $this->tester->getLocator()->notexist()->client();
    }
}