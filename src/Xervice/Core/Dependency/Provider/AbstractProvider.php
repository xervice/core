<?php
declare(strict_types=1);


namespace Xervice\Core\Dependency\Provider;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Locator\Locator;

abstract class AbstractProvider implements ProviderInterface
{
    /**
     * @var \Xervice\Core\Locator\Locator
     */
    private $locator;

    /**
     * AbstractProvider constructor.
     *
     * @param \Xervice\Core\Locator\Locator $locator
     */
    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
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
}