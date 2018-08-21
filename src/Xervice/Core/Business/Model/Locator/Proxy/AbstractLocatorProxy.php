<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy;


use Xervice\Core\Business\Model\Config\AbstractConfig;
use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Dependency\AbstractDependencyContainer;
use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy;
use Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxyInterface;
use Xervice\Core\Business\Model\Locator\Proxy\Communication\CommunicationLocatorProxy;
use Xervice\Core\Business\Model\Locator\Proxy\Communication\CommunicationLocatorProxyInterface;
use Xervice\Core\Business\Model\Locator\Proxy\Persistence\PersistenceLocatorProxy;
use Xervice\Core\Business\Model\Locator\Proxy\Persistence\PersistenceLocatorProxyInterface;

abstract class AbstractLocatorProxy implements LocatorProxyInterface
{
    /**
     * @var array
     */
    protected $coreNamespaces;

    /**
     * @var array
     */
    protected $projectNamespaces;

    /**
     * @var string
     */
    protected $serviceName;

    /**
     * @var \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected $config;

    /**
     * @var \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected $container;

    /**
     * @var \Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxyInterface
     */
    protected $businessLocator;

    /**
     * @var \Xervice\Core\Business\Model\Locator\Proxy\Communication\CommunicationLocatorProxyInterface
     */
    protected $communicationLocator;

    /**
     * @var \Xervice\Core\Business\Model\Locator\Proxy\Persistence\PersistenceLocatorProxyInterface
     */
    protected $persistenceLocator;

    /**
     * AbstractLocatorProxy constructor.
     *
     * @param array $coreNamespaces
     * @param array $projectNamespaces
     * @param string $serviceName
     */
    public function __construct(array $coreNamespaces, array $projectNamespaces, string $serviceName)
    {
        $this->coreNamespaces = $coreNamespaces;
        $this->projectNamespaces = $projectNamespaces;
        $this->serviceName = $serviceName;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->serviceName;
    }

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy
     */
    public function businessLocator(): BusinessLocatorProxyInterface
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

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Communication\CommunicationLocatorProxy
     */
    public function communicationLocator(): CommunicationLocatorProxyInterface
    {
        if ($this->communicationLocator === null) {
            $this->communicationLocator = new CommunicationLocatorProxy(
                $this->coreNamespaces,
                $this->projectNamespaces,
                $this->name()
            );
        }

        return $this->communicationLocator;
    }

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Persistence\PersistenceLocatorProxy
     */
    public function persistenceLocator(): PersistenceLocatorProxyInterface
    {
        if ($this->communicationLocator === null) {
            $this->communicationLocator = new PersistenceLocatorProxy(
                $this->coreNamespaces,
                $this->projectNamespaces,
                $this->name()
            );
        }

        return $this->communicationLocator;
    }

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function config(): ConfigInterface
    {
        if ($this->config === null) {
            $class = $this->getServiceClass('Config') ?: AbstractConfig::class;
            $this->config = new $class();
        }

        return $this->config;
    }

    /**
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected function container(): DependencyContainerInterface
    {
        if ($this->container === null) {
            $this->container = new AbstractDependencyContainer(
                $this->config()
            );

            $provider = $this->getServiceClass('DependencyProvider', $this->getDirectory());
            if ($provider) {
                $this->container = $this->container->register(
                    new $provider($this->config())
                );
            }
        }

        return $this->container;
    }

    /**
     * @param string $suffix
     * @param string|null $directory
     *
     * @return string|null
     */
    protected function getServiceClass(string $suffix, string $directory = null): ?string
    {
        return $this->getServiceClassFromNamespaces(
            $this->projectNamespaces,
            $suffix,
            $directory
        ) ?: $this->getServiceClassFromNamespaces(
            $this->coreNamespaces,
            $suffix,
            $directory
        );
    }

    /**
     * @param array $namespaces
     * @param string $suffix
     * @param string|null $directory
     *
     * @return null|string
     */
    protected function getServiceClassFromNamespaces(
        array $namespaces,
        string $suffix,
        string $directory = null
    ): ?string {
        $serviceClass = null;

        foreach ($namespaces as $namespace) {
            $class = $this->getNamespace($namespace, $suffix, $directory);
            if (class_exists($class)) {
                $serviceClass = $class;
                break;
            }
        }

        return $serviceClass;
    }

    /**
     * @param string $primaryNamespace
     * @param string $suffix
     * @param string|null $directory
     *
     * @return string
     */
    protected function getNamespace(string $primaryNamespace, string $suffix, string $directory = null): string
    {
        return sprintf(
            '\\%1$s\\%2$s%4$s\\%2$s%3$s',
            $primaryNamespace,
            $this->name(),
            $suffix,
            $directory ? '\\' . $directory : ''
        );
    }

    /**
     * @return null|string
     */
    protected function getDirectory(): ?string
    {
        return null;
    }
}