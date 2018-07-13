<?php
declare(strict_types=1);

namespace Xervice\Core\Dependency;

use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Dependency\Provider\ProviderInterface;
use Xervice\Core\Locator\Locator;

interface DependencyProviderInterface extends \ArrayAccess
{
    /**
     * @param string $name
     * @param callable $function
     *
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     */
    public function set(string $name, callable $function): DependencyProviderInterface;

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name);

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig(): ConfigInterface;

    /**
     * @return \Generated\Ide\LocatorAutoComplete|\Xervice\Core\Locator\Locator
     */
    public function getLocator(): Locator;

    /**
     * @param \Xervice\Core\Dependency\Provider\ProviderInterface $provider
     */
    public function register(ProviderInterface $provider): void;
}