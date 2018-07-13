<?php


namespace Xervice\Core\Dependency;


abstract class AbstractDependencyProvider implements DependencyProviderInterface
{
    /**
     * @var callable[]
     */
    protected $container;

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return callable
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

}