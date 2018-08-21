<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy;


use Xervice\Core\Business\Model\Facade\FacadeInterface;

class LocatorProxy extends AbstractLocatorProxy
{
    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface
    {
        return $this->businessLocator()->facade();
    }

}