<?php
declare(strict_types=1);

namespace Xervice\Core\Plugin;

use Xervice\Core\Business\Model\Locator\Dynamic\Communication\DynamicCommunicationLocator;

/**
 * @method \Xervice\Core\Business\Model\Facade\AbstractFacade getFacade()
 * @method \Xervice\Core\Business\Model\Factory\AbstractCommunicationFactory getFactory()
 */
abstract class AbstractCommunicationPlugin
{
    use DynamicCommunicationLocator;
}