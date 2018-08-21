<?php
namespace XerviceTest\Core\Business\Locator\Dynamic;

use Xervice\Core\Business\CoreBusinessFactory;
use Xervice\Core\Business\CoreFacade;
use Xervice\Core\Business\Model\Locator\Dynamic\Business\DynamicBusinessLocator;

class BusinessTest extends \Codeception\Test\Unit
{
    use DynamicBusinessLocator;

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Locator
     * @group Dynamic
     */
    public function testGetFacade()
    {
        $this->assertInstanceOf(
            CoreFacade::class,
            $this->getFacade()
        );
    }

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Locator
     * @group Dynamic
     */
    public function testGetFactory()
    {
        $this->assertInstanceOf(
            CoreBusinessFactory::class,
            $this->getFactory()
        );
    }
}