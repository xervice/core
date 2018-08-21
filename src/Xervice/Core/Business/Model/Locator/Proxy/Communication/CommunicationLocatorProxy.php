<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy\Communication;


use Xervice\Core\Business\Model\Facade\FacadeInterface;
use Xervice\Core\Business\Model\Factory\AbstractCommunicationFactory;
use Xervice\Core\Business\Model\Factory\FactoryInterface;
use Xervice\Core\Business\Model\Locator\Proxy\AbstractLocatorProxy;

class CommunicationLocatorProxy extends AbstractLocatorProxy implements CommunicationLocatorProxyInterface
{
    private const DIRECTORY = 'Communication';

    /**
     * @var \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    private $factory;

    /**
     * @return \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    public function factory(): FactoryInterface
    {
        if ($this->factory === null) {
            $class = $this->getServiceClass('CommunicationFactory', self::DIRECTORY) ?: AbstractCommunicationFactory::class;
            $this->factory = new $class(
                $this->config(),
                $this->container()
            );
        }

        return $this->factory;
    }

    /**
     * @return \Xervice\Core\Business\Model\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface
    {
        return $this->businessLocator()->facade();
    }

    /**
     * @return null|string
     */
    protected function getDirectory(): ?string
    {
        return self::DIRECTORY;
    }
}