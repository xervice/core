<?php


namespace Xervice\Core\Facade;


abstract class AbstractFacade
{
    /**
     * @var \Xervice\Core\Factory\FactoryInterface
     */
    protected $factory;

    /**
     * AbstractFacade constructor.
     *
     * @param \Xervice\Core\Factory\FactoryInterface $factory
     */
    public function __construct(\Xervice\Core\Factory\FactoryInterface $factory)
    {
        $this->factory = $factory;
    }


}