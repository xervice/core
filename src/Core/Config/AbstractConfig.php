<?php


namespace Xervice\Core\Config;


use Xervice\Config\XerviceConfig;

abstract class AbstractConfig implements ConfigInterface
{
    /**
     * @var \Xervice\Config\Container\ConfigContainer
     */
    private $config;

    /**
     * AbstractConfig constructor.
     */
    public function __construct()
    {
        $this->config = XerviceConfig::getInstance()->getConfig();
    }

    /**
     * @param string $name
     * @param string|null $default
     *
     * @return mixed
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function get(string $name, string $default = null)
    {
        return $this->config->get($name, $default);
    }


}