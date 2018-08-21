<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Factory;


use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Facade\FacadeInterface;

class AbstractCommunicationFactory implements FactoryInterface
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
     * @var \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    protected $facade;

    /**
     * AbstractCommunicationFactory constructor.
     *
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     * @param \Xervice\Core\Business\Model\Facade\FacadeInterface $facade
     */
    public function __construct(
        ConfigInterface $config,
        DependencyContainerInterface $container,
        FacadeInterface $facade
    ) {
        $this->config = $config;
        $this->container = $container;
        $this->facade = $facade;
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

    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function getFacade(): FacadeInterface
    {
        return $this->facade;
    }


}