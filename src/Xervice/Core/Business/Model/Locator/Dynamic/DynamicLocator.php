<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Dynamic;


use Xervice\Core\Business\Exception\ServiceNotFoundException;
use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Locator\Locator;
use Xervice\Core\Business\Model\Locator\Proxy\LocatorProxy;

trait DynamicLocator
{
    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function getFacade(): FacadeInterface
    {
        return $this->getLocator()->facade();
    }

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\LocatorProxy
     */
    protected function getLocator(): LocatorProxy
    {
        return Locator::getInstance()->{$this->getServiceName()}();
    }

    /**
     * @return string
     * @throws \Xervice\Core\Business\Exception\ServiceNotFoundException
     */
    protected function getServiceName(): string
    {
        if (!preg_match('@([A-Za-z]+)\\\\([A-Za-z]+)\\\\([A-Za-z\\\\]+)@', \get_class($this), $matches)) {
            throw new ServiceNotFoundException(__NAMESPACE__);
        }

        return $matches[2];
    }
}