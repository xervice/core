<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy;


use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Locator\BusinessLocator;
use Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy;

class LocatorProxy extends AbstractLocatorProxy
{
    /**
     * @var \Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy
     */
    protected $businessLocator;

    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface
    {
        return $this->businessLocator()->facade();
    }

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy
     */
    public function businessLocator(): BusinessLocatorProxy
    {
        if ($this->businessLocator === null) {
            $this->businessLocator = new BusinessLocatorProxy(
                $this->coreNamespaces,
                $this->projectNamespaces,
                $this->name()
            );
        }

        return $this->businessLocator;
    }
}