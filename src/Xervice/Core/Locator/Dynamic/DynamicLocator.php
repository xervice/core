<?php
declare(strict_types=1);


namespace Xervice\Core\Locator\Dynamic;


use Core\Locator\Dynamic\ServiceNotParseable;
use Xervice\Core\Client\ClientInterface;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Facade\FacadeInterface;
use Xervice\Core\Factory\FactoryInterface;
use Xervice\Core\Locator\Locator;
use Xervice\Core\Locator\Proxy\ProxyInterface;

trait DynamicLocator
{
    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            $method = lcfirst(str_replace('get', '', $name));
            return $this->getLocator()->{$method}();
        }
    }

    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getFactory(): FactoryInterface
    {
        return $this->getLocator()->factory();
    }

    /**
     * @return \Xervice\Core\Facade\FacadeInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getFacade(): FacadeInterface
    {
        return $this->getLocator()->facade();
    }

    /**
     * @return \Xervice\Core\Client\ClientInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getClient(): ClientInterface
    {
        return $this->getLocator()->client();
    }

    /**
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getContainer(): DependencyProviderInterface
    {
        return $this->getLocator()->container();
    }

    /**
     * @return \Xervice\Core\Locator\Proxy\ProxyInterface
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    private function getLocator(): ProxyInterface
    {
        return Locator::getInstance()->{$this->getServiceName()}();
    }

    /**
     * @return string
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getServiceName(): string
    {
        if (!preg_match('@([A-Za-z]+)\\\\([A-Za-z]+)\\\\([A-Za-z\\\\]+)@', \get_class($this), $matches)) {
            throw new ServiceNotParseable(__NAMESPACE__);
        }

        return $matches[2];
    }
}
