<?php


namespace XerviceTest\Core\Locator\Helper;


use Xervice\Core\HelperClass\HelperInterface;
use Xervice\Core\Locator\Proxy\ProxyInterface;

class TestHelper implements HelperInterface
{
    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return 'myTest';
    }

    /**
     * @param \Xervice\Core\Locator\Proxy\ProxyInterface $proxy
     *
     * @return mixed|string
     */
    public function getHelper(ProxyInterface $proxy)
    {
        return $proxy->getServiceName();
    }


}