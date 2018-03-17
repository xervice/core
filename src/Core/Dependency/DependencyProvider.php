<?php


namespace Xervice\Core\Dependency;


use Pimple\Container;
use Xervice\Config\XerviceConfig;


class DependencyProvider extends Container implements DependencyProviderInterface
{
    /**
     * @param string $name
     * @param callable $function
     *
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     */
    public function set(string $name, callable $function)
    {
        $this[$name] = $function;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return $this[$name];
    }


    /**
     * @return \Xervice\Config\Container\ConfigContainer
     */
    public function getConfig()
    {
        return XerviceConfig::getInstance()->getConfig();
    }
}