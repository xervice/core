<?php
declare(strict_types=1);


namespace Xervice\Core\Facade;


use Xervice\Core\Client\ClientInterface;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Factory\FactoryInterface;

abstract class AbstractFacade implements FacadeInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * AbstractFacade constructor.
     *
     * @param \Xervice\Core\Factory\FactoryInterface $factory
     * @param \Xervice\Core\Config\ConfigInterface $config
     * @param ClientInterface $client
     */
    public function __construct(
        FactoryInterface $factory,
        ConfigInterface $config,
        ClientInterface $client
    ) {
        $this->factory = $factory;
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig() : ConfigInterface
    {
        return $this->config;
    }

    /**
     * @return FactoryInterface
     */
    public function getFactory() : FactoryInterface
    {
        return $this->factory;
    }

    /**
     * @return \Xervice\Core\Client\ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }
}