<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy\Persistence;


use Xervice\Core\Business\Model\Facade\AbstractFacade;
use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\Core\Business\Model\Factory\FactoryInterface;
use Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy;
use Xervice\Core\Business\Model\Persistence\Reader\AbstractReader;
use Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface;
use Xervice\Core\Business\Model\Persistence\Writer\AbstractWriter;
use Xervice\Core\Business\Model\Persistence\Writer\WriterInterface;

class PersistenceLocatorProxy extends AbstractLocatorProxy implements PersistenceLocatorProxyInterface
{
    private const DIRECTORY = 'Persistence';

    /**
     * @var \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface
     */
    private $reader;

    /**
     * @var \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface
     */
    private $writer;

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface
     */
    public function reader(): ReaderInterface
    {
        if ($this->reader === null) {
            $class = $this->getServiceClass('DataReader', self::DIRECTORY) ?: AbstractReader::class;
            $this->reader = new $class(
                $this->config()
            );
        }

        return $this->reader;
    }

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface
     */
    public function writer(): WriterInterface
    {
        if ($this->writer === null) {
            $class = $this->getServiceClass('DataWriter', self::DIRECTORY) ?: AbstractWriter::class;
            $this->writer = new $class(
                $this->config()
            );
        }

        return $this->writer;
    }
}