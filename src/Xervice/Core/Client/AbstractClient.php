<?php
declare(strict_types=1);


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
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     */
    public function getFactory(): FactoryInterface
    {
        return $this->factory;
    }
}
