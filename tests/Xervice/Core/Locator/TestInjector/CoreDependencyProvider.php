<?php


namespace Test\Core;


use Xervice\Core\CoreDependencyProvider as XerviceCoreDependencyProvider;
use XerviceTest\Core\Locator\Helper\TestHelper;

class CoreDependencyProvider extends XerviceCoreDependencyProvider
{
    protected function getHelper(): array
    {
        return [
            new TestHelper()
        ];
    }
}