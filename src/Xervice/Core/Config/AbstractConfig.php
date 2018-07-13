<?php


namespace Xervice\Core\Config;


use Xervice\Config\Exception\ConfigNotFound;
use Xervice\Config\XerviceConfig;
use Xervice\Core\Locator\Locator;

abstract class AbstractConfig implements ConfigInterface
{
    /**
     * @var \Xervice\Config\Container\ConfigContainer
     */
    private $config;

    /**
     * AbstractConfig constructor.
     * @throws \Xervice\Config\Exception\FileNotFound
     */
    public function __construct()
    {
        $this->config = XerviceConfig::getInstance()->getConfig();
    }

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        try {
            return $this->config->get($name, $default);
        } catch (ConfigNotFound $exception) {
            Locator::getInstance()->exceptionHandler()->facade()->handleException();
        }
    }


}