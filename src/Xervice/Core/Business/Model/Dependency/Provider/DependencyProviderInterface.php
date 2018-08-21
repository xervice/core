<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Dependency\Provider;


use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;

interface DependencyProviderInterface
{
    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     */
    public function handleDependencies(DependencyContainerInterface $container): void;
}