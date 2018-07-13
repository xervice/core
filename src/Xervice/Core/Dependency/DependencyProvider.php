<?php
declare(strict_types=1);


namespace Xervice\Core\Dependency;


use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Dependency\Provider\ProviderInterface;
use Xervice\Core\Locator\Locator;


class DependencyProvider extends AbstractDependencyProvider implements DependencyProviderInterface
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
    public function set(string $name, callable $function): DependencyProviderInterface
    {
        $this->container[$name] = $function;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->container[$name]();
    }

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    /**
     * @return \Generated\Ide\LocatorAutoComplete|\Xervice\Core\Locator\Locator
     */
    public function getLocator(): Locator
    {
        return Locator::getInstance();
    }

    /**
     * @param \Xervice\Core\Dependency\Provider\ProviderInterface $provider
     */
    public function register(ProviderInterface $provider): void
    {
        $provider->handleDependencies($this);
    }


}