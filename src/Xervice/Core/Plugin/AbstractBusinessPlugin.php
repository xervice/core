<?php
declare(strict_types=1);

namespace Xervice\Core\Plugin;


use Xervice\Core\Business\Model\Locator\Dynamic\Business\DynamicBusinessLocator;

/**
 * @method \Xervice\Core\Business\Model\Facade\AbstractFacade getFacade()
 * @method \Xervice\Core\Business\Model\Factory\AbstractBusinessFactory getFactory()
 */
abstract class AbstractBusinessPlugin
{
    use DynamicBusinessLocator;
}