<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy\Communication;

use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Factory\FactoryInterface;

interface CommunicationLocatorProxyInterface
{
    /**
     * @return \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    public function factory(): FactoryInterface;

    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface;
}