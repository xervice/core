<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Factory;


use Xervice\Core\Business\Model\Config\ConfigInterface;
use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface;
use Xervice\Core\Business\Model\Persistence\Writer\WriterInterface;

class AbstractBusinessFactory implements FactoryInterface
{
    /**
     * @var \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected $config;

    /**
     * @var \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected $container;

    /**
     * @var \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface
     */
    protected $reader;

    /**
     * @var \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface
     */
    protected $writer;

    /**
     * AbstractBusinessFactory constructor.
     *
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     * @param \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface $reader
     * @param \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface $writer
     */
    public function __construct(
        ConfigInterface $config,
        DependencyContainerInterface $container,
        ReaderInterface $reader,
        WriterInterface $writer
    ) {
        $this->config = $config;
        $this->container = $container;
        $this->reader = $reader;
        $this->writer = $writer;
    }


    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    protected function getDependency(string $key)
    {
        return $this->container->get($key);
    }

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Reader\ReaderInterface
     */
    public function getReader(): ReaderInterface
    {
        return $this->reader;
    }

    /**
     * @return \Xervice\Core\Business\Model\Persistence\Writer\WriterInterface
     */
    public function getWriter(): WriterInterface
    {
        return $this->writer;
    }


}