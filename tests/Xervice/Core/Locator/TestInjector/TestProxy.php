<?php


namespace XerviceTest\Core\Locator\TestInjector;


use Xervice\Core\Locator\Proxy\XerviceLocatorProxy;

class TestProxy extends XerviceLocatorProxy
{
    /**
     * @return string
     */
    public function testing(): string
    {
        return 'MyTest';
    }
}