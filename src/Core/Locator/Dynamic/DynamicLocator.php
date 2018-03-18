<?php


namespace Xervice\Core\Locator\Dynamic;


use Xervice\Core\Locator\Locator;

trait DynamicLocator
{
    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getFactory()
    {
        return $this->getLocator()->factory();
    }

    /**
     * @return \Xervice\Core\Facade\FacadeInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getFacade()
    {
        return $this->getLocator()->facade();
    }

    /**
     * @return \Xervice\Core\Client\ClientInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getClient()
    {
        return $this->getLocator()->client();
    }

    /**
     * @return \Xervice\Core\Locator\Proxy\ProxyInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    private function getLocator()
    {
        return Locator::getInstance()->{$this->getServiceName()}();
    }

    /**
     * @return string
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    private function getServiceName()
    {
        if (!preg_match('@([A-Za-z]+)\\\\([A-Za-z]+)\\\\([A-Za-z\\\\]+)@', get_class($this), $matches)) {
            throw new ServiceNotParseable(__NAMESPACE__);
        }

        return $matches[2];
    }
}