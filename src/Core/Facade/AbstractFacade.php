<?php


namespace Xervice\Core\Facade;


use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Factory\FactoryInterface;

abstract class AbstractFacade implements FacadeInterface
{
    /**
     * @var \Xervice\Core\Factory\FactoryInterface
     */
    protected $factory;

    /**
     * @var \Xervice\Core\Config\ConfigInterface
     */
    private $config;

    /**
     * AbstractFacade constructor.
     *
     * @param \Xervice\Core\Factory\FactoryInterface $factory
     * @param \Xervice\Core\Config\ConfigInterface $config
     */
    public function __construct(
        FactoryInterface $factory,
        ConfigInterface $config
    ) {
        $this->factory = $factory;
        $this->config = $config;
    }


    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     */
    public function getFactory()
    {
        return $this->factory;
    }
}