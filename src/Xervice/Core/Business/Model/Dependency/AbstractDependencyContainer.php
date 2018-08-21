<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Dependency;


use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Dependency\Provider\DependencyProviderInterface;

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
     * AbstractDependencyContainer constructor.
     *
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
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
     */
    public function register(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider->handleDependencies($this);
    }

    /**
     * @param string $name
     * @param callable $callable
     */
    public function extend(string $name, callable $callable): void
    {
        $value = $this->offsetGet($name);
        $this->offsetUnset($name);
        $this->offsetSet($name, $callable($value));
    }

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}