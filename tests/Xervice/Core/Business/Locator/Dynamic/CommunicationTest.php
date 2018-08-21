<?php
namespace XerviceTest\Core\Business\Locator\Dynamic;

use Xervice\Core\Business\CoreFacade;
use Xervice\Core\Business\Model\Factory\AbstractCommunicationFactory;
use Xervice\Core\Business\Model\Locator\Dynamic\Communication\DynamicCommunicationLocator;

class CommunicationTest extends \Codeception\Test\Unit
{
    use DynamicCommunicationLocator;

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
            AbstractCommunicationFactory::class,
            $this->getFactory()
        );
    }
}