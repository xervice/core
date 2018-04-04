<?php


namespace Xervice\Core\Locator\Proxy;


use Xervice\Config\XerviceConfig;
use Xervice\Core\CoreConfig;
use Xervice\Core\Dependency\DependencyProvider;
use Xervice\Core\Locator\Exception\LocatorClientNotFound;
use Xervice\Core\Locator\Exception\LocatorConfigNotFound;
use Xervice\Core\Locator\Exception\LocatorFacadeNotFound;
use Xervice\Core\Locator\Exception\LocatorFactoryNotFound;
use Xervice\Core\Locator\Locator;

class XerviceLocatorProxy implements ProxyInterface
{
    const NAMESPACE_PROXY_FORMAT = '\%1$s\\%2$s\\%2$s%3$s';

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
     * @var \Xervice\Core\Config\ConfigInterface
     */
    private $config;

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
     * @return null|\Xervice\Core\Config\ConfigInterface
     * @throws \Xervice\Core\Locator\Exception\LocatorConfigNotFound
     */
    public function config()
    {
        if ($this->config === null) {
            foreach ($this->getServiceNamespaces('Config') as $class) {
                if (class_exists($class)) {
                    $this->config = new $class();
                    break;
                }
            }

            if ($this->config === null) {
                throw new LocatorConfigNotFound($this->service);
            }
        }
        return $this->config;
    }

    /**
     * @return null|\Xervice\Core\Factory\FactoryInterface
     * @throws \Xervice\Core\Locator\Exception\LocatorConfigNotFound
     * @throws \Xervice\Core\Locator\Exception\LocatorFactoryNotFound
     */
    public function factory()
    {
        if ($this->factory === null) {
            foreach ($this->getServiceNamespaces('Factory') as $class) {
                if (class_exists($class)) {
                    $this->factory = new $class(
                        $this->getContainer(),
                        $this->config()
                    );
                    break;
                }
            }

            if ($this->factory === null) {
                throw new LocatorFactoryNotFound($this->service);
            }
        }
        return $this->factory;
    }

    /**
     * @return null|\Xervice\Core\Facade\FacadeInterface
     * @throws \Xervice\Core\Locator\Exception\LocatorClientNotFound
     * @throws \Xervice\Core\Locator\Exception\LocatorConfigNotFound
     * @throws \Xervice\Core\Locator\Exception\LocatorFacadeNotFound
     * @throws \Xervice\Core\Locator\Exception\LocatorFactoryNotFound
     */
    public function facade()
    {
        if ($this->facade === null) {
            foreach ($this->getServiceNamespaces('Facade') as $class) {
                if (class_exists($class)) {
                    $this->facade = new $class(
                        $this->factory(),
                        $this->config(),
                        $this->client()
                    );
                    break;
                }
            }

            if ($this->facade === null) {
                throw new LocatorFacadeNotFound($this->service);
            }
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
            foreach ($this->getServiceNamespaces('Client') as $class) {
                if (class_exists($class)) {
                    $this->client = new $class(
                        $this->factory(),
                        $this->config()
                    );
                    break;
                }
            }

            if ($this->client === null) {
                throw new LocatorClientNotFound($this->service);
            }
        }
        return $this->client;
    }

    /**
     * @return \Xervice\Core\Dependency\DependencyProvider|\Xervice\Core\Dependency\DependencyProviderInterface
     * @throws \Xervice\Core\Locator\Exception\LocatorConfigNotFound
     */
    private function getContainer()
    {
        if ($this->container === null) {
            $this->container = new DependencyProvider($this->config());
            $this->registerDependencies();
        }
        return $this->container;
    }

    private function registerDependencies()
    {
        foreach ($this->getServiceNamespaces('DependencyProvider') as $class) {
            if (class_exists($class)) {
                $this->container->register(new $class(Locator::getInstance()));
                break;
            }
        }
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private function getNamespace(string $type, string $layer): string
    {
        return sprintf(
            self::NAMESPACE_PROXY_FORMAT,
            $layer,
            $this->service,
            $type
        );
    }

    /**
     * @return string
     */
    private function getProjectLayerName()
    {
        return XerviceConfig::getInstance()->getConfig()->get(CoreConfig::PROJECT_LAYER_NAMESPACE, 'App');
    }

    /**
     * @return array
     */
    private function getServiceNamespaces(string $type): array
    {
        $xerviceNamespaces = [
            $this->getNamespace($type, $this->getProjectLayerName()),
            $this->getNamespace($type, 'Xervice')
        ];
        return $xerviceNamespaces;
    }

}