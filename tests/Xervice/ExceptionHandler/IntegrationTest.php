<?php
namespace XerviceTest\ExceptionHandler;

use Xervice\ExceptionHandler\ExceptionHandlerConfig;
use Xervice\Config\XerviceConfig;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \Xervice\ExceptionHandler\ExceptionHandlerFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group ExceptionHandler
     * @group Integration
     */
    public function testHandleException()
    {
        $config = XerviceConfig::getInstance()->getConfig();
        $config->set(ExceptionHandlerConfig::IS_DEBUG, true);
        $config->set(ExceptionHandlerConfig::SHUTDOWN_IF_ERROR, false);

        $exception = new \Exception("Test-Message-For-Looking");

        ob_start();
        $this->getFacade()->handleException($exception);

        $contents = ob_get_contents();
        ob_end_clean();

        $this->assertContains(
            'Test-Message-For-Looking',
            $contents
        );
    }
}