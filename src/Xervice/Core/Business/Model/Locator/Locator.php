<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator;


use Xervice\Config\Business\XerviceConfig;
use Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy;
use Xervice\Core\Business\Model\Locator\Proxy\LocatorProxy;
use Xervice\Core\Business\Model\Locator\Proxy\LocatorProxyInterface;
use Xervice\Core\CoreConfig;

class Locator
{
    /**
     * @var \Xervice\Core\Business\Model\Locator\Locator
     */
    private static $instance;

    /**
     * @var array
     */
    protected $coreNamespaces;

    /**
     * @var array
     */
    protected $projectNamespaces;

    /**
     * @var array
     */
    protected $services;

    /**
     * Locator constructor.
     *
     * @param array $coreNamespaces
     * @param array $projectNamespaces
     */
    public function __construct(array $coreNamespaces, array $projectNamespaces)
    {
        $this->coreNamespaces = $coreNamespaces;
        $this->projectNamespaces = $projectNamespaces;
        $this->services = [];
    }

    /**
     * @return \Xervice\Core\Business\Model\Locator\Locator
     */
    public static function getInstance(): Locator
    {
        if (self::$instance === null) {
            self::$instance = new self(
                XerviceConfig::get(CoreConfig::CORE_NAMESPACES, ['Xervice']),
                XerviceConfig::get(CoreConfig::PROJECT_NAMESPACES, ['App'])
            );
        }
        return self::$instance;
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return \Xervice\Core\Business\Model\Locator\Proxy\LocatorProxyInterface
     */
    public function __call(string $name, array $arguments)
    {
        if (!isset($this->services[$name])) {
            $this->services[$name] = $this->getServiceProxy($name);
        }

        return $this->services[$name];
    }

    /**
     * @param string $service
     *
     * @return \Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy
     */
    protected function getServiceProxy(string $service): LocatorProxyInterface
    {
        return new LocatorProxy(
            $this->coreNamespaces,
            $this->projectNamespaces,
            ucfirst($service)
        );
    }
}
