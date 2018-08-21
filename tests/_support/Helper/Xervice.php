<?php
namespace XerviceTest\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Xervice\OldCore\Locator\Locator;

class Xervice extends \Codeception\Module
{
    /**
     * @return \Xervice\OldCore\Locator\Locator
     */
    public function getLocator()
    {
        return Locator::getInstance();
    }
}
