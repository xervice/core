<?php
declare(strict_types=1);


namespace Xervice\Core\Dependency\Provider;


use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Locator\Locator;

abstract class AbstractProvider implements ProviderInterface
{
    /**
     * @var \Xervice\Core\Locator\Locator
     */
    private $locator;

    /**
     * @var \Xervice\Core\Config\ConfigInterface
     */
    private $config;

    /**
     * AbstractProvider constructor.
     *
     * @param \Xervice\Core\Locator\Locator $locator
     * @param \Xervice\Core\Config\ConfigInterface $config
     */
    public function __construct(Locator $locator, ConfigInterface $config)
    {
        $this->locator = $locator;
        $this->config = $config;
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function register(DependencyProviderInterface $dependencyProvider): void
    {
        $this->handleDependencies($dependencyProvider);
    }

    /**
     * @param string $module
     * @param string $dependency
     * @param callable $callable
     */
    protected function injectDependency(string $module, string $dependency, callable $callable): void
    {
        $this->getLocator()->$module()->container()->set($dependency, $callable);
    }

    /**
     * @return \Xervice\Core\Locator\Locator
     */
    protected function getLocator() : Locator
    {
        return $this->locator;
    }

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}