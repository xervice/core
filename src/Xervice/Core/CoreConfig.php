<?php
declare(strict_types=1);

namespace Xervice\Core;


use Xervice\Core\Business\Model\Config\AbstractConfig;

class CoreConfig extends AbstractConfig
{
    public const CORE_NAMESPACES = 'xervice.core.core.namespaces';
    public const PROJECT_NAMESPACES = 'xervice.core.project.namespaces';
}