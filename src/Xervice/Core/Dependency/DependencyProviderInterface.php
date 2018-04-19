<?php

namespace Xervice\Core\Dependency;

interface DependencyProviderInterface
{
    /**
     * @param string $name
     * @param callable $function
     *
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     */
    public function set(string $name, callable $function);

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name);

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig();

    /**
     * @return \Xervice\Generated\Ide\LocatorAutoComplete|\Xervice\Core\Locator\Locator
     */
    public function getLocator();
}