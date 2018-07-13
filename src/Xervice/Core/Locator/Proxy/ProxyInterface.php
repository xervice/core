<?php
declare(strict_types=1);


namespace Xervice\Core\Locator\Proxy;


use Xervice\Core\Client\ClientInterface;
use Xervice\Core\Facade\FacadeInterface;
use Xervice\Core\Factory\FactoryInterface;

interface ProxyInterface
{
    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     */
    public function factory(): FactoryInterface;

    /**
     * @return \Xervice\Core\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface;

    /**
     * @return \Xervice\Core\Client\ClientInterface
     */
    public function client(): ClientInterface;
}