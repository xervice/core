<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Dynamic\Business;


use Xervice\Core\Business\Exception\ServiceNotFoundException;
use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Factory\FactoryInterface;
use Xervice\Core\Business\Model\Locator\Locator;
use Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy;

trait DynamicBusinessLocator
{
    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function getFacade(): FacadeInterface
    {
        return $this->getLocator()->facade();
    }

    /**
     * @return \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    public function getFactory(): FactoryInterface
    {
        return $this->getLocator()->factory();
    }

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy
     */
    protected function getLocator(): BusinessLocatorProxy
    {
        return Locator::getInstance()->{$this->getServiceName()}()->businessLocator();
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