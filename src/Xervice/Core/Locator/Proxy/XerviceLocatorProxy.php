<?php


namespace Xervice\Core\Locator\Proxy;


use Xervice\Core\Client\EmptyClient;
use Xervice\Core\Config\EmptyConfig;
use Xervice\Core\Dependency\DependencyProvider;
use Xervice\Core\Facade\EmptyFacade;
use Xervice\Core\Factory\EmptyFactory;
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
     * @var string
     */
    private $projectNamespace;

    /**
     * XerviceLocatorProxy constructor.
     *
     * @param string $service
     */
    public function __construct(string $service, string $projectNamespace)
    {
        $this->service = ucfirst($service);
        $this->projectNamespace = $projectNamespace;
    }

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
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
                $this->config = new EmptyConfig();
            }
        }
        return $this->config;
    }

    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
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
                $this->factory = new EmptyFactory(
                    $this->getContainer(),
                    $this->config()
                );
            }
        }
        return $this->factory;
    }

    /**
     * @return \Xervice\Core\Facade\FacadeInterface
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
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
                $this->facade = new EmptyFacade(
                    $this->factory(),
                    $this->config(),
                    $this->client()
                );
            }
        }
        return $this->facade;
    }

    /**
     * @return \Xervice\Core\Client\ClientInterface
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
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
                $this->client = new EmptyClient(
                    $this->factory(),
                    $this->config()
                );
            }
        }
        return $this->client;
    }

    /**
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
     */
    private function getContainer()
    {
        if ($this->container === null) {
            $this->container = new DependencyProvider($this->config());
            $this->registerDependencies();
        }
        return $this->container;
    }

    /**
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
     */
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
     * @return mixed
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
     */
    private function getProjectLayerName()
    {
        return $this->projectNamespace;
    }

    /**
     * @param string $type
     *
     * @return array
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
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