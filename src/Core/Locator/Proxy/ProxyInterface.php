<?php


namespace Xervice\Core\Locator\Proxy;


interface ProxyInterface
{
    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     */
    public function factory();

    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     */
    public function facade();

    /**
     * @return \Xervice\Core\Client\ClientInterface
     */
    public function client();
}