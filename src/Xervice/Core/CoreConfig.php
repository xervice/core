<?php
declare(strict_types=1);


namespace Xervice\Core;



use Xervice\Core\Config\AbstractConfig;

class CoreConfig extends AbstractConfig
{
    public const PROJECT_LAYER_NAMESPACE = 'project.layer.namespace';

    public const ADDITIONAL_LAYER_NAMESPACES = 'additional.layer.namespaces';
}
