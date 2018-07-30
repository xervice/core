<?php


namespace Test\Core;


use Xervice\Core\CoreFactory as XerviceCoreFactory;
use Xervice\Core\Locator\Proxy\ProxyInterface;
use XerviceTest\Core\Locator\TestInjector\TestProxy;

class CoreFactory extends XerviceCoreFactory
{
    /**
     * @param string $service
     * @param string $projectNamespace
     * @param array $additionalNamespaces
     *
     * @return \Xervice\Core\Locator\Proxy\ProxyInterface
     */
    public function createXerviceLocatorProxy(string $service, string $projectNamespace, array $additionalNamespaces): ProxyInterface
    {
        return new TestProxy(
            $service,
            $projectNamespace,
            $additionalNamespaces
        );
    }

}