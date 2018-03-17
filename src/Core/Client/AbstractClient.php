<?php


namespace Xervice\Core\Client;


use Xervice\Core\Factory\FactoryInterface;

abstract class AbstractClient
{
    /**
     * @var \Xervice\Core\Factory\FactoryInterface
     */
    protected $factory;

    /**
     * AbstractClient constructor.
     *
     * @param \Xervice\Core\Factory\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }


}