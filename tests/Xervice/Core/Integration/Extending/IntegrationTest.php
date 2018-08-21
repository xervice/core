<?php
namespace XerviceTest\Core\Integration\Extending;

use App\Core\Business\CoreFacade;
use Xervice\Core\Business\Model\Locator\Locator;

require __DIR__ . '/Test/CoreFacade.php';

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @group Xervice
     * @group Core
     * @group Integration
     * @group Extending
     */
    public function testExtendingFacade()
    {
        $this->assertInstanceOf(
            CoreFacade::class,
            Locator::getInstance()->core()->facade()
        );
    }
}