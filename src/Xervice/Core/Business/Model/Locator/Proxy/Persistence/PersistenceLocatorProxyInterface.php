<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy\Persistence;

use Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface;
use Xervice\Core\Business\Model\Persistence\Writer\WriterInterface;

interface PersistenceLocatorProxyInterface
{
    /**
     * @return \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface
     */
    public function reader(): ReaderInterface;

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface
     */
    public function writer(): WriterInterface;
}