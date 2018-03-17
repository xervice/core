<?php


namespace Xervice\Core\Client;


use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Factory\FactoryInterface;

abstract class AbstractClient implements ClientInterface
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
     * AbstractClient constructor.
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


}