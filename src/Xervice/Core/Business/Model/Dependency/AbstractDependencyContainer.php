<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Dependency;


use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Dependency\Provider\DependencyProviderInterface;
use Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy;
use Xervice\Core\Business\Model\Locator\Proxy\LocatorProxyInterface;

class AbstractDependencyContainer implements DependencyContainerInterface
{
    /**
     * @var array
     */
    private $dependencies;

    /**
     * @var array
     */
    private $values;

    /**
     * @var \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    private $config;

    /**
     * @var \Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy
     */
    private $locator;

    /**
     * AbstractDependencyContainer constructor.
     *
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     * @param \Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy $locator
     */
    public function __construct(
        ConfigInterface $config,
        AbstractLocatorProxy $locator
    ) {
        $this->config = $config;
        $this->locator = $locator;
    }

    /**
     * @param string $name
     * @param callable $callable
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function set(string $name, callable $callable): DependencyContainerInterface
    {
        $this->offsetSet($name, $callable);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->offsetGet($name);
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->dependencies[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if (!isset($this->values[$offset])) {
            $this->values[$offset] = $this->dependencies[$offset]($this);
        }

        return $this->values[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->dependencies[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->dependencies[$offset], $this->values[$offset]);
    }

    /**
     * @param \Xervice\Core\Business\Model\Dependency\Provider\DependencyProviderInterface $dependencyProvider
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function register(DependencyProviderInterface $dependencyProvider): DependencyContainerInterface
    {
        $this->values = [];
        return $dependencyProvider->handleDependencies($this);
    }

    /**
     * @param string $name
     * @param callable $callable
     */
    public function extend(string $name, callable $callable): void
    {
        $value = $this->offsetGet($name);
        $this->offsetUnset($name);
        $this->offsetSet($name, function () use ($callable, $value) {
            return $callable($value);
        });
    }

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy
     */
    protected function getLocator(): AbstractLocatorProxy
    {
        return $this->locator;
    }
}