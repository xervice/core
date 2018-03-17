<?php


namespace Xervice\Core\Dependency;


use Pimple\ServiceProviderInterface;

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
     * @param \Pimple\ServiceProviderInterface $provider
     */
    public function register(ServiceProviderInterface $provider);

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig();
}