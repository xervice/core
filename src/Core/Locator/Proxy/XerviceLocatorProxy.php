<?php


namespace Xervice\Core\Locator\Proxy;


use Xervice\Core\Dependency\DependencyProvider;
use Xervice\Core\Locator\Exception\LocatorClientNotFound;
use Xervice\Core\Locator\Exception\LocatorFacadeNotFound;
use Xervice\Core\Locator\Exception\LocatorFactoryNotFound;
use Xervice\Core\Locator\Locator;

class XerviceLocatorProxy implements ProxyInterface
{
    const NAMESPACE_PROXY_FORMAT = 'Xervice\\%1$s\\%1$s%2$s';

    /**
     * @var string
     */
    private $service;

    /**
     * @var \Xervice\Core\Dependency\DependencyProviderInterface
     */
    private $container;

    /**
     * @var \Xervice\Core\Factory\FactoryInterface
     */
    private $factory;

    /**
     * @var \Xervice\Core\Facade\FacadeInterface
     */
    private $facade;

    /**
     * @var \Xervice\Core\Client\ClientInterface
     */
    private $client;

    /**
     * XerviceLocatorProxy constructor.
     *
     * @param string $service
     */
    public function __construct(string $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     * @throws \Xervice\Core\Locator\Exception\LocatorFactoryNotFound
     */
    public function factory()
    {
        if ($this->factory === null) {
            $factoryClass = $this->getNamespace('Factory');
            if (!class_exists($factoryClass)) {
                throw new LocatorFactoryNotFound($this->service);
            }

            $this->factory = new $factoryClass(
                $this->getContainer()
            );
        }
        return $this->factory;
    }

    /**
     * @return \Xervice\Core\Facade\FacadeInterface|\Xervice\Core\Factory\FactoryInterface
     * @throws \Xervice\Core\Locator\Exception\LocatorFacadeNotFound
     * @throws \Xervice\Core\Locator\Exception\LocatorFactoryNotFound
     */
    public function facade()
    {
        if ($this->facade === null) {
            $facadeClass = $this->getNamespace('Facade');
            if (!class_exists($facadeClass)) {
                throw new LocatorFacadeNotFound($this->service);
            }

            $this->facade = new $facadeClass(
                $this->factory()
            );
        }
        return $this->facade;
    }

    /**
     * @return \Xervice\Core\Client\ClientInterface
     * @throws \Xervice\Core\Locator\Exception\LocatorClientNotFound
     * @throws \Xervice\Core\Locator\Exception\LocatorFactoryNotFound
     */
    public function client()
    {
        if ($this->client === null) {
            $clientClass = $this->getNamespace('Client');
            if (!class_exists($clientClass)) {
                throw new LocatorClientNotFound($this->service);
            }

            $this->client = new $clientClass(
                $this->factory()
            );
        }
        return $this->client;
    }

    /**
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     */
    private function getContainer()
    {
        if ($this->container === null) {
            $this->container = new DependencyProvider();
            $this->registerDependencies();
        }
        return $this->container;
    }

    private function registerDependencies()
    {
        $providerClass = $this->getNamespace('DependencyProvider');
        if (class_exists($providerClass)) {
            $this->container->register(new $providerClass(Locator::getInstance()));
        }
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private function getNamespace(string $type): string
    {
        return sprintf(
            self::NAMESPACE_PROXY_FORMAT,
            $this->service,
            $type
        );
    }

}