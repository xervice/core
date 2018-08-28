<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Dependency;


use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Dependency\Provider\DependencyProviderInterface;
use Xervice\Core\Business\Model\Locator\Locator;

interface DependencyContainerInterface extends \ArrayAccess
{
    /**
     * @param string $name
     * @param callable $callable
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function set(string $name, callable $callable): DependencyContainerInterface;

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name);

    /**
     * @param \Xervice\Core\Business\Model\Dependency\Provider\DependencyProviderInterface $dependencyProvider
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function register(DependencyProviderInterface $dependencyProvider): DependencyContainerInterface;

    /**
     * @param string $name
     * @param callable $callable
     */
    public function extend(string $name, callable $callable): void;

    /**
     * @return \Generated\Ide\LocatorAutoComplete|Xervice\Core\Business\Model\Locator\Locator
     */
    public function getLocator(): Locator;

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    public function getConfig(): ConfigInterface;
}