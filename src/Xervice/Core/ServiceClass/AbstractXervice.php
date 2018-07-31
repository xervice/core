<?php


namespace Xervice\Core\ServiceClass;


use Xervice\Core\Config\ConfigInterface;

class AbstractXervice implements XerviceInterface
{
    /**
     * @var \Xervice\Core\Config\ConfigInterface
     */
    private $config;

    /**
     * AbstractXervice constructor.
     *
     * @param \Xervice\Core\Config\ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}