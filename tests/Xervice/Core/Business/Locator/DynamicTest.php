<?php
namespace XerviceTest\Core\Business\Locator;

use Xervice\Core\Business\CoreFacade;
use Xervice\Core\Business\Model\Locator\Dynamic\DynamicLocator;

class DynamicTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group Xervice
     * @group Core
     * @group Business
     * @group Locator
     */
    public function testGetFacade()
    {
        $this->assertInstanceOf(
            CoreFacade::class,
            $this->getFacade()
        );
    }
}