<?php
namespace XerviceTest\Core\Business;

use Xervice\Core\Business\CoreBusinessFactory;
use Xervice\Core\Business\CoreFacade;
use Xervice\Core\Business\Model\Locator\Locator;
use Xervice\Core\Business\Model\Locator\Proxy\LocatorProxy;

class LocatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Locator
     */
    public function testLocatorGetInstance()
    {
        $this->assertInstanceOf(
            Locator::class,
            Locator::getInstance()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Locator
     */
    public function testLocatorLocateCore()
    {
        $this->assertInstanceOf(
            LocatorProxy::class,
            Locator::getInstance()->core()
        );

        $this->assertEquals(
            'Core',
            Locator::getInstance()->core()->name()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Locator
     */
    public function testLocatorLocateCoreBusinessFacade()
    {
        $this->assertInstanceOf(
            CoreFacade::class,
            Locator::getInstance()->core()->facade()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Locator
     */
    public function testLocatorLocateCoreBusinessFactory()
    {
        $this->assertInstanceOf(
            CoreBusinessFactory::class,
            Locator::getInstance()->core()->businessLocator()->factory()
        );
    }
}