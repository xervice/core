<?php


namespace Xervice\Core\Factory;


use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Dependency\DependencyProviderInterface;

class AbstractFactory implements FactoryInterface
{
    /**
     * @var \Xervice\Core\Dependency\DependencyProviderInterface
     */
    private $dependencyProvider;

    /**
     * @var \Xervice\Core\Config\ConfigInterface
     */
    private $config;

    /**
     * AbstractFactory constructor.
     *
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     * @param \Xervice\Core\Config\ConfigInterface $config
     */
    public function __construct(
        DependencyProviderInterface $dependencyProvider,
        ConfigInterface $config
    ) {
        $this->dependencyProvider = $dependencyProvider;
        $this->config = $config;
    }


    /**
     * @param string $key
     *
     * @return mixed
     */
    protected function getDependency(string $key)
    {
        return $this->dependencyProvider->get($key);
    }

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    protected function getConfig()
    {
        return $this->config;
    }
}