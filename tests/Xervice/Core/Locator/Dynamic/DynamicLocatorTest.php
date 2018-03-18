<?php
namespace XerviceTest\Core\Locator\Dynamic;

use Test\Core\CoreFacade;
use Xervice\Core\CoreClient;
use Xervice\Core\CoreFactory;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

class DynamicLocatorTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;

    /**
     * @group Xervice
     * @group Core
     * @group Locator
     * @group Dynamic
     * @group DynamicLocator
     */
    public function testDynamicLocator()
    {
        $this->assertInstanceOf(
            CoreFactory::class,
            $this->getFactory()
        );

        $this->assertInstanceOf(
            CoreFacade::class,
            $this->getFacade()
        );

        $this->assertInstanceOf(
            CoreClient::class,
            $this->getClient()
        );
    }
}