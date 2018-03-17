<?php


namespace Xervice\Core\Locator;


use Xervice\Core\Locator\Proxy\XerviceLocatorProxy;

class Locator
{
    /**
     * @var \Xervice\Core\Locator\Locator
     */
    private static $instance;

    /**
     * @var array
     */
    private $proxies = [];

    /**
     * @return \Xervice\Core\Locator\Locator
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function __call($name, $arguments)
    {
        if (!isset($this->proxies[$name])) {
            $this->proxies[$name] = new XerviceLocatorProxy($name);
        }

        return $this->proxies[$name];
    }

}