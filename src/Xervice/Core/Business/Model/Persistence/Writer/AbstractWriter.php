<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Persistence\Writer;


use Xervice\Core\Business\Model\Config\ConfigInterface;

class AbstractWriter
{
    /**
     * @var \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    private $config;

    /**
     * AbstractReader constructor.
     *
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}
