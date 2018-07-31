<?php


namespace XerviceTest\Core\Locator\Helper;


use Test\Core\CoreFactory;
use Xervice\Core\CoreConfig;
use Xervice\Core\HelperClass\HelperInterface;
use Xervice\Core\Locator\Proxy\ProxyInterface;
use Xervice\Core\ServiceClass\XerviceInterface;

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
     * @return \Xervice\Core\ServiceClass\XerviceInterface
     */
    public function getHelper(ProxyInterface $proxy): XerviceInterface
    {
        return new CoreConfig();
    }


}