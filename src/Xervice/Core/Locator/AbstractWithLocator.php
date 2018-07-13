<?php
declare(strict_types=1);


namespace Xervice\Core\Locator;


use Xervice\Core\Locator\Dynamic\DynamicLocator;

abstract class AbstractWithLocator
{
    use DynamicLocator;
}