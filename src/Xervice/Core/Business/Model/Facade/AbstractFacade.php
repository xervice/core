<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Facade;


use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Factory\FactoryInterface;

class AbstractFacade implements FacadeInterface
{
    /**
     * @var \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    protected $factory;

    /**
     * @var \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected $config;

    /**
     * AbstractFacade constructor.
     *
     * @param \Xervice\Core\Business\Model\Factory\FactoryInterface $factory
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     */
    public function __construct(
        FactoryInterface $factory,
        ConfigInterface $config
    ) {
        $this->factory = $factory;
        $this->config = $config;
    }


    /**
     * @return \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    protected function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}