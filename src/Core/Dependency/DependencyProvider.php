<?php


namespace Xervice\Core\Dependency;


use Pimple\Container;
use Xervice\Config\XerviceConfig;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Locator\Locator;


class DependencyProvider extends Container implements DependencyProviderInterface
{
    /**
     * @var \Xervice\Core\Config\ConfigInterface
     */
    private $config;

    /**
     * DependencyProvider constructor.
     *
     * @param \Xervice\Core\Config\ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }


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
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return \Xervice\Core\Locator\Locator
     */
    public function getLocator()
    {
        return Locator::getInstance();
    }
}