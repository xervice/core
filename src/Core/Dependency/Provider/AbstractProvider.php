<?php


namespace Xervice\Core\Dependency\Provider;


use Pimple\Container;
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
     * @param \Pimple\Container $container
     */
    public function register(Container $container)
    {
        $this->handleDependencies($container);
    }

    /**
     * @return \Xervice\Core\Locator\Locator
     */
    protected function getLocator() : Locator
    {
        return $this->locator;
    }
}