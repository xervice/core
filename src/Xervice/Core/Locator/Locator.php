<?php


namespace Xervice\Core\Locator;


use Xervice\Config\XerviceConfig;
use Xervice\Core\CoreConfig;
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
     * @var string
     */
    private $projectNamespace;

    /**
     * @var array
     */
    private $additionalNamespaces;

    /**
     * Locator constructor.
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
     */
    public function __construct()
    {
        $this->projectNamespace = XerviceConfig::getInstance()->getConfig()->get(CoreConfig::PROJECT_LAYER_NAMESPACE, 'App');
        $this->additionalNamespaces = XerviceConfig::getInstance()->getConfig()->get(CoreConfig::ADDITIONAL_LAYER_NAMESPACES, []);
    }


    /**
     * @return \Generated\Ide\LocatorAutoComplete|\Xervice\Core\Locator\Locator
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return \Xervice\Core\Locator\Proxy\XerviceLocatorProxy
     */
    public function __call($name, $arguments)
    {
        if (!isset($this->proxies[$name])) {
            $this->proxies[$name] = new XerviceLocatorProxy(
                $name,
                $this->projectNamespace,
                $this->additionalNamespaces
            );
        }

        return $this->proxies[$name];
    }

}