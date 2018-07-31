<?php
declare(strict_types=1);


namespace Xervice\Core\Locator\Proxy;


use Xervice\Core\Client\ClientInterface;
use Xervice\Core\Client\EmptyClient;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Config\EmptyConfig;
use Xervice\Core\Dependency\DependencyProvider;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Facade\EmptyFacade;
use Xervice\Core\Facade\FacadeInterface;
use Xervice\Core\Factory\EmptyFactory;
use Xervice\Core\Factory\FactoryInterface;
use Xervice\Core\HelperClass\HelperCollection;
use Xervice\Core\Locator\Locator;

class XerviceLocatorProxy implements ProxyInterface
{
    private const NAMESPACE_PROXY_FORMAT = '\%1$s\\%2$s\\%2$s%3$s';

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
     * @var array
     */
    private $additionalNamespaces;

    /**
     * @var \Xervice\Core\HelperClass\HelperCollection
     */
    private $helperCollection;

    /**
     * @var array
     */
    private $helperList;

    /**
     * XerviceLocatorProxy constructor.
     *
     * @param string $service
     * @param string $projectNamespace
     * @param array $additionalNamespaces
     * @param \Xervice\Core\HelperClass\HelperCollection|null $helperCollection
     */
    public function __construct(
        string $service,
        string $projectNamespace,
        array $additionalNamespaces,
        HelperCollection $helperCollection = null
    ) {
        $this->service = ucfirst($service);
        $this->projectNamespace = $projectNamespace;
        $this->additionalNamespaces = $additionalNamespaces;
        $this->helperCollection = $helperCollection;
        $this->helperList = [];
    }

    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name) && $this->helperCollection !== null) {
            if (!isset($this->helperList[$name])) {
                foreach ($this->helperCollection as $helper) {
                    if ($helper->getMethodName() === $name) {
                        $this->helperList[$name] = $helper->getHelper($this->service);
                        break;
                    }
                }
            }

            return $this->helperList[$name] ?? null;
        }
    }


    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function config(): ConfigInterface
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
     */
    public function factory(): FactoryInterface
    {
        if ($this->factory === null) {
            foreach ($this->getServiceNamespaces('Factory') as $class) {
                if (class_exists($class)) {
                    $this->factory = new $class(
                        $this->container(),
                        $this->config()
                    );
                    break;
                }
            }

            if ($this->factory === null) {
                $this->factory = new EmptyFactory(
                    $this->container(),
                    $this->config()
                );
            }
        }
        return $this->factory;
    }

    /**
     * @return \Xervice\Core\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface
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
     */
    public function client(): ClientInterface
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
     */
    public function container(): DependencyProviderInterface
    {
        if ($this->container === null) {
            $this->container = new DependencyProvider($this->config());
            $this->registerDependencies();
        }
        return $this->container;
    }

    private function registerDependencies(): void
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
     * @param string $layer
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
     * @param string $type
     *
     * @return array
     */
    private function getServiceNamespaces(string $type): array
    {
        $xerviceNamespaces = [];

        foreach ($this->additionalNamespaces as $addNamespace) {
            $xerviceNamespaces[] = $this->getNamespace($type, $addNamespace);
        }

        $xerviceNamespaces[] = $this->getNamespace($type, $this->projectNamespace);
        $xerviceNamespaces[] = $this->getNamespace($type, 'Xervice');

        return $xerviceNamespaces;
    }
}
