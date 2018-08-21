<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Factory;


use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;

class AbstractBusinessFactory implements FactoryInterface
{
    /**
     * @var \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected $config;

    /**
     * @var \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected $container;

    /**
     * AbstractBusinessFactory constructor.
     *
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     */
    public function __construct(ConfigInterface $config, DependencyContainerInterface $container)
    {
        $this->config = $config;
        $this->container = $container;
    }

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    protected function getDependency(string $key)
    {
        return $this->container->get($key);
    }
}