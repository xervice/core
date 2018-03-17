<?php


namespace Xervice\Core\Dependency\Provider;


use Pimple\ServiceProviderInterface;
use Xervice\Core\Dependency\DependencyProviderInterface;

interface ProviderInterface extends ServiceProviderInterface
{
    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container);
}