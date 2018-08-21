<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Config;

use Xervice\Config\Business\XerviceConfig;

class AbstractConfig implements ConfigInterface
{
    /**
     * @var \Xervice\Config\Business\Container\ConfigContainer
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
     * @param mixed $default
     *
     * @return mixed
     */
    protected function get(string $name, $default = null)
    {
        return $this->config->get($name, $default);
    }
}
