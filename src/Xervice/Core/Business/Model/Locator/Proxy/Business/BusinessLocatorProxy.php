<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy\Business;


use Xervice\Core\Business\Model\Facade\AbstractFacade;
use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\Core\Business\Model\Factory\FactoryInterface;
use Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy;
use Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface;
use Xervice\Core\Business\Model\Persistence\Writer\WriterInterface;

class BusinessLocatorProxy extends AbstractLocatorProxy implements BusinessLocatorProxyInterface
{
    private const DIRECTORY = 'Business';

    /**
     * @var \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    private $factory;

    /**
     * @var \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    private $facade;

    /**
     * @return \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    public function factory(): FactoryInterface
    {
        if ($this->factory === null) {
            $class = $this->getServiceClass('BusinessFactory', self::DIRECTORY) ?: AbstractBusinessFactory::class;
            $this->factory = new $class(
                $this->config(),
                $this->container(),
                $this->reader(),
                $this->writer()
            );
        }

        return $this->factory;
    }

    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface
    {
        if ($this->facade === null) {
            $class = $this->getServiceClass('Facade', self::DIRECTORY) ?: AbstractFacade::class;
            $this->facade = new $class(
                $this->factory()
            );
        }

        return $this->facade;
    }

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface
     */
    public function reader(): ReaderInterface
    {
        return $this->persistenceLocator()->reader();
    }

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface
     */
    public function writer(): WriterInterface
    {
        return $this->persistenceLocator()->writer();
    }
}