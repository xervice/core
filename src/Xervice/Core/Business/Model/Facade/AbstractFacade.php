<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Facade;


use Xervice\Core\Business\Model\Factory\FactoryInterface;

class AbstractFacade implements FacadeInterface
{
    /**
     * @var \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    protected $factory;

    /**
     * AbstractFacade constructor.
     *
     * @param \Xervice\Core\Business\Model\Factory\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return \Xervice\Core\Business\Model\Factory\FactoryInterface
     */
    protected function getFactory(): FactoryInterface
    {
        return $this->factory;
    }
}