<?php


namespace Xervice\Core\Factory;


use Xervice\Config\XerviceConfig;
use Xervice\Core\Dependency\DependencyProviderInterface;

class AbstractFactory implements FactoryInterface
{
    /**
     * @var \Xervice\Core\Dependency\DependencyProviderInterface
     */
    private $dependencyProvider;

    /**
     * AbstractFactory constructor.
     *
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function __construct(DependencyProviderInterface $dependencyProvider)
    {
        $this->dependencyProvider = $dependencyProvider;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getDependency(string $key)
    {
        return $this->dependencyProvider->get($key);
    }

    /**
     * @return \Xervice\Config\Container\ConfigContainer
     */
    public function getConfig()
    {
        return XerviceConfig::getInstance()->getConfig();
    }
}