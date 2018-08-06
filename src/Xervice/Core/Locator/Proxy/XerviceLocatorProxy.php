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
use Xervice\Core\ServiceClass\EmptyXervice;
use Xervice\Core\ServiceClass\XerviceInterface;

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
     *
     * @return mixed|null
     */
    public function __call($name, $arguments)
    {
        return !method_exists($this, $name) ? $this->dynamic($name) : null;
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

    /**
     * @param string $type
     *
     * @return array
     */
    public function getServiceNamespaces(string $type): array
    {
        $xerviceNamespaces = [];

        foreach ($this->additionalNamespaces as $addNamespace) {
            $xerviceNamespaces[] = $this->getNamespace($type, $addNamespace);
        }

        $xerviceNamespaces[] = $this->getNamespace($type, $this->projectNamespace);
        $xerviceNamespaces[] = $this->getNamespace($type, 'Xervice');

        return $xerviceNamespaces;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->service;
    }

    private function registerDependencies(): void
    {
        foreach ($this->getServiceNamespaces('DependencyProvider') as $class) {
            if (class_exists($class)) {
                $this->container->register(
                    new $class(
                        Locator::getInstance(),
                        $this->config()
                    )
                );
                break;
            }
        }
    }

    /**
     * @param $name
     *
     * @return \Xervice\Core\ServiceClass\XerviceInterface
     */
    protected function dynamic($name): XerviceInterface
    {
        if (!isset($this->helperList[$name])) {
            $this->getDynamicClassFromName($name);
        }

        if (!isset($this->helperList[$name])) {
            $this->getHelperFromName($name);
        }

        if (!isset($this->helperList[$name])) {
            $this->getEmptyXervice($name);
        }

        return $this->helperList[$name];
    }

    /**
     * @param string $type
     * @param string $layer
     *
     * @return string
     */
    protected function getNamespace(string $type, string $layer): string
    {
        return sprintf(
            self::NAMESPACE_PROXY_FORMAT,
            $layer,
            $this->getServiceName(),
            $type
        );
    }

    /**
     * @param $name
     */
    protected function getHelperFromName($name): void
    {
        if ($this->helperCollection instanceof HelperCollection) {
            foreach ($this->helperCollection as $helper) {
                if ($helper->getMethodName() === $name) {
                    $this->helperList[$name] = $helper->getHelper($this);
                    break;
                }
            }
        }
    }

    /**
     * @param $name
     */
    protected function getEmptyXervice($name): void
    {
        $this->helperList[$name] = new EmptyXervice(
            $this->config()
        );
    }

    /**
     * @param $name
     */
    protected function getDynamicClassFromName($name): void
    {
        foreach ($this->getServiceNamespaces(ucfirst($name)) as $class) {
            if (class_exists($class)) {
                $this->helperList[$name] = new $class(
                    $this->config()
                );
                break;
            }
        }
    }
}
