<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy\Business;

use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Factory\FactoryInterface;
use Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface;
use Xervice\Core\Business\Model\Persistence\Writer\WriterInterface;

interface BusinessLocatorProxyInterface
{
    /**
     * @return \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    public function factory(): FactoryInterface;

    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface;

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface
     */
    public function reader(): ReaderInterface;

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface
     */
    public function writer(): WriterInterface;
}